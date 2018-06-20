<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Department;
use App\Models\Objective;
use App\Models\Partake;

use App\Models\Keyresult;
use App\Models\Plan;

use Illuminate\Support\Facades\DB;

use Validator;

class PlanController extends Controller
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
            'p_name' => 'required|',
            'p_date' => 'required|',
            'p_partake_id' => 'required|',
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


        $data['name'] = $request->p_name;
        $data['executor_id'] = session("idUser");

        $arr_date = explode(" - ", $request->p_date);
        $data['startdate'] = $arr_date[0];
        $data['enddate'] = $arr_date[1];
        
        $data['description'] = $request->p_description;

        $data['pid'] = $request->pid;

        $arr_partake_id = $request->p_partake_id;
        
        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $plan = Plan::create($data);
        // var_dump($objective->id);die();
        // return;
        if($plan===false){
            $array = array('msg'=>'新增计划失败!','status'=>0);
            return json_encode($array);
        }else{

            foreach ($arr_partake_id as $v) {
               $arr_partake[] = ['okr_id'=>$plan->id,'user_id'=>$v,'created_at'=>date("Y-m-d H:i:s")];
            }
            // var_dump($arr_partake);
            
            DB::table('partake')->insert($arr_partake);

            $array = array('msg'=>'新增计划成功!','status'=>1);
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
        
        $item = Plan::find($request->id);
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
        
        $item = Plan::find($request->id);
        $item->load("partake","keyresult");
        
        // $item->load("partake");
        $item = $item->toArray();
        // dd($item);
        $item['newpartake'] = array_column($item['partake'],"user_id");
        $item['dateStatus'] = Objective::getDateStatus($item['startdate'],$item['enddate'],$item['score'],$item['scoretime']);
        
        // 能否删除标记
        // $item['candel'] = Objective::ifCandel($item)[0];
        $item['candel'] = Plan::ifCandel($item);
        
        // dd($item);
        return json_encode($item);
    }


    // 更新
    public function update(Request $request)
    {
        
        $rules = [
            'p_id' => 'required|integer',
            'p_date' => 'required|',
            'p_partake_id' => 'required|',
            
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
        
        // 接收数据
        $data['id'] = $request->p_id;
        $arr_date = explode(" - ", $request->p_date);
        $data['startdate'] = $arr_date[0];
        $data['enddate'] = $arr_date[1];
        $data['description'] = $request->p_description;
        $arr_partake_id = $request->p_partake_id;


        $item = Plan::find($data['id']);
        // dd($item);
        $item->startdate=$data['startdate'];
        $item->enddate=$data['enddate'];
        $item->description=$data['description'];

        // $arr_partake_id = $request->o_partake_id;

        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{

            // 删参与者 增参与者
            $arr_where['okr_id'] = $request->kr_id; 
            $del_num = Partake::where($arr_where)->delete();

            foreach ($arr_partake_id as $v) {
               $arr_partake[] = ['okr_id'=>$data['id'],'user_id'=>$v,'created_at'=>date("Y-m-d H:i:s")];
            }
            // var_dump($arr_partake);
            
            DB::table('partake')->insert($arr_partake);

            // Partake::addAll($arr_partake);

            $array = array('msg'=>'编辑成功!','status'=>1);
            return json_encode($array);
        }
    }


    // 删除
    public function delete(Request $request)
    {
        
        $rules = [
            'p_id' => 'required|integer',
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
        
        // 接收数据
        $data['id'] = $request->p_id;

        $item = Plan::find($data['id']);
        $item['dateStatus'] = Objective::getDateStatus($item['startdate'],$item['enddate'],$item['score'],$item['scoretime']);
        $item['candel'] = Plan::ifCandel($item);

        // 不能删就返回
        if($item['candel'][0]==0){
            $array = array('msg'=>$item['candel'][1],'status'=>0);
            return json_encode($array);
        }

        // dd($item);

        unset($item['candel']);
        unset($item['dateStatus']);

        $item->status=1;
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'删除失败!','status'=>0);
            return json_encode($array);
        }else{

            // 删不删参与者呢？这是个问题，先不删了吧，万一哪天要恢复呢
            // 删参与者 增参与者
            // $arr_where['okr_id'] = $request->o_id; 
            // $del_num = Partake::where($arr_where)->delete();
            
            // DB::table('partake')->insert($arr_partake);

            $array = array('msg'=>'删除成功!','status'=>1);
            return json_encode($array);
        }
    }

}
