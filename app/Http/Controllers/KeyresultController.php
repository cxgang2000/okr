<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Department;
use App\Models\Objective;

use App\Models\Keyresult;
use App\Models\Confidentindex;


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
            'kr_description' => 'required|',
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

        
        $data['description'] = $request->kr_description;
        $data['pid'] = $request->pid;

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

            $data = array();
            $data['okr_id'] = $keyresult->id;
            $data['oldconfidentindex'] = "5/10";
            $data['newconfidentindex'] = "5/10";
            $data['description'] = "创建关键结果。";
            // var_dump($data);
            $confidentindex = Confidentindex::create($data);


            // $data = array();
            // $data['okr_id'] = $keyresult->id;
            // $data['oldconfidentindex'] = "5/10";
            // $data['newconfidentindex'] = "5/10";
            // $data['description'] = "创建关键结果。";
            
            // DB::table('confidentindex')->insert($data);



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
        
        $item = Keyresult::find($request->id);
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
        
        $item = Keyresult::find($request->id);
        $item->load("comments.userName","confidentindex");

        $item = $item->toArray();
        // dd($item);
        return json_encode($item);
    }


    // 更新
    public function update(Request $request)
    {
        
        $rules = [
            'kr_id' => 'required|integer',
            'kr_description' => 'required|',
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
        $data['id'] = $request->kr_id;
        $data['description'] = $request->kr_description;
       
        $item = Keyresult::find($data['id']);
        // dd($item);
        $item->description=$data['description'];

        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'编辑成功!','status'=>1);
            return json_encode($array);
        }
    }

    // 更新信心指数
    public function updateConfidentindex(Request $request)
    {
        
        $rules = [
            'okr_id' => 'required|',
            'oldconfidentindex' => 'required|',
            'newconfidentindex' => 'required|',
            'description' => 'required|',
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
        $data['id'] = $request->okr_id;
        
        $item = Keyresult::find($data['id']);
        // dd($item);
        $item->confidentindex=$request->newconfidentindex;

        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{

            $data = array();
            $data['okr_id'] = $request->okr_id;
            $data['oldconfidentindex'] = $request->oldconfidentindex;
            $data['newconfidentindex'] = $request->newconfidentindex;
            $data['description'] = $request->description;
            // var_dump($data);
            $confidentindex = Confidentindex::create($data);


            $array = array('msg'=>'编辑成功!','status'=>1);
            return json_encode($array);
        }
    }

    // 删除
    public function delete(Request $request)
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
        
        // 接收数据
        $data['id'] = $request->id;

        $item = Keyresult::find($data['id']);
        
        // $item['canDel'] = Keyresult::ifCandel($item);
        // // 不能删就返回
        // if($item['canDel'][0]==0){
        //     $array = array('msg'=>$item['canDel'][1],'status'=>0);
        //     return json_encode($array);
        // }

        // dd($item);

        $item->status=1;
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'删除失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'删除成功!','status'=>1);
            return json_encode($array);
        }
    }
}
