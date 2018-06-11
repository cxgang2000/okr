<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Department;
use App\Models\Objective;
use App\Models\Partake;

use App\Models\Plan;

use Illuminate\Support\Facades\DB;

use Validator;

class KeyresultController extends Controller
{

    public function __construct()
    {
 
        // 验证是否登录
        $this->middleware(function ($request, $next) {
            if (!$request->session()->has('idUser')) {
                redirect('index/login')->send();exit();
            }             
            return $next($request);
        });
    }


    public function store(Request $request)
    {
        $rules = [
            'kr_name' => 'required|',
            'kr_date' => 'required|',
            'kr_partake_id' => 'required|',
        ];

        $validator = Validator::make($request->all(), $rules);
        // var_dump($validator);
        if ($validator->fails()) {
            // echo "fail";
            // var_dump($validator->getMessageBag()->toArray());
            $arr_err = $validator->getMessageBag()->toArray();
            $str_err = "";
            foreach ($arr_err as $v) {
                // echo $value;
                // var_dump($v);
                $str_err = $str_err . $v[0]."<br>";
            }
            $array = array('msg'=>$str_err,'status'=>0);
            return json_encode($array);
        }


        $data['name'] = $request->kr_name;
        $data['executor_id'] = session("idUser");

        $arr_date = explode(" - ", $request->kr_date);
        $data['startdate'] = $arr_date[0];
        $data['enddate'] = $arr_date[1];
        
        $data['description'] = $request->kr_description;

        $arr_partake_id = $request->kr_partake_id;
        
        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $keyresult = Keyresult::create($data);
        // var_dump($objective->id);die();
        // return;

        if($keyresult===false){
            $array = array('msg'=>'新增关键结果失败!','status'=>0);
            return json_encode($array);
        }else{

            foreach ($arr_partake_id as $v) {
               $arr_partake[] = ['okr_id'=>$keyresult->id,'user_id'=>$v,'created_at'=>date("Y-m-d H:i:s")];
            }
            // var_dump($arr_partake);
            
            DB::table('partake')->insert($arr_partake);

            $array = array('msg'=>'新增关键结果成功!','status'=>1);
            return json_encode($array);
            
        }
    }


    // 评分
    public function score(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
            'score' => 'required|',
        ];

        $validator = Validator::make($request->all(), $rules);
        // var_dump($validator);
        if ($validator->fails()) {
            // echo "fail";
            // var_dump($validator->getMessageBag()->toArray());
            $arr_err = $validator->getMessageBag()->toArray();
            $str_err = "";
            foreach ($arr_err as $v) {
                // echo $value;
                // var_dump($v);
                $str_err = $str_err . $v[0]."<br>";
            }
            $array = array('msg'=>$str_err,'status'=>0);
            return json_encode($array);
        }
        
        $item = Objective::find($request->id);
        // dd($item);
        $data['score'] = $request->score;
        $data['scoretime'] = date("Y-m-d H:i:s");
        // var_dump($data);die();
        // $item->save($data);
        $item->score=$request->score;
        $item->scoretime=date("Y-m-d H:i:s");
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'打分失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'打分成功!','status'=>1);
            return json_encode($array);
        }
    }


    // 详情
    public function detail(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        // var_dump($validator);
        if ($validator->fails()) {
            // echo "fail";
            // var_dump($validator->getMessageBag()->toArray());
            $arr_err = $validator->getMessageBag()->toArray();
            $str_err = "";
            foreach ($arr_err as $v) {
                // echo $value;
                // var_dump($v);
                $str_err = $str_err . $v[0]."<br>";
            }
            $array = array('msg'=>$str_err,'status'=>0);
            return json_encode($array);
        }
        
        $item = Objective::find($request->id);
        $item->load("executor","partake");
        $item->load("executor","partake");
        
        // $item->load("partake");
        $item = $item->toArray();
        // dd($item);
        $item['newpartake'] = array_column($item['partake'],"user_id");
        $item['dateStatus'] = Objective::getDateStatus($item['startdate'],$item['enddate'],$item['score'],$item['scoretime']);
        
        
        // dd($item);
        return json_encode($item);
    }


    // 更新
    public function update(Request $request)
    {
        
        $rules = [
            'o_id' => 'required|integer',
            'o_date' => 'required|',
            'o_partake_id' => 'required|',
            
        ];

        $validator = Validator::make($request->all(), $rules);
        // var_dump($validator);
        if ($validator->fails()) {
            // echo "fail";
            // var_dump($validator->getMessageBag()->toArray());
            $arr_err = $validator->getMessageBag()->toArray();
            $str_err = "";
            foreach ($arr_err as $v) {
                // echo $value;
                // var_dump($v);
                $str_err = $str_err . $v[0]."<br>";
            }
            $array = array('msg'=>$str_err,'status'=>0);
            return json_encode($array);
        }
        
        $item = Objective::find($request->o_id);
        // dd($item);
        $arr_date = explode(" - ", $request->o_date);
        $item->startdate=$arr_date[0];
        $item->enddate=$arr_date[1];
        $item->description=$request->o_description;

        $item->save();
        // dd($item);



        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{

            // 删参与者 增参与者

            $array = array('msg'=>'编辑成功!','status'=>1);
            return json_encode($array);
        }
    }

}
