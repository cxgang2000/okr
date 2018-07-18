<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Confidentindex;

use Validator;

class ConfidentindexController extends Controller
{

    public function __construct()
    {
 
        // // 验证是否登录
        // $this->middleware(function ($request, $next) {
        //     if (!$request->session()->has('idUser')) {
        //         redirect('index/login')->send();exit();
        //     }             
        //     return $next($request);
        // });
    }


    public function store(Request $request)
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

        $data['okr_id'] = $request->okr_id;
        $data['oldconfidentindex'] = $request->oldconfidentindex;
        $data['newconfidentindex'] = $request->newconfidentindex;
        $data['description'] = $request->description;
        
        // dd($data);
        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $confidentindex = Confidentindex::create($data);
        // var_dump($objective->id);die();
        // return;
        if($confidentindex===false){
            $array = array('msg'=>'信心指数编辑失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'信心指数编辑成功!','status'=>1);
            return json_encode($array);
        }
    }

    public function index(Request $request)
    {
        $rules = [
            'okr_id' => 'required|integer',
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

        $arr_where[] = ["okr_id",$request->okr_id];
        $arr_comment = Comment::where($arr_where)->orderBy("id desc")->select();
        dd($arr_comment->toArray());

    }
   

}
