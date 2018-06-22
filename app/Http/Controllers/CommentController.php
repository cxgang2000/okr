<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Comment;


use Illuminate\Support\Facades\DB;

use Validator;

class CommentController extends Controller
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
            'comment' => 'required|',
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

        $data['comment'] = $request->comment;
        $data['user_id'] = session("idUser");
        $data['okr_id'] = $request->okr_id;
        
        // dd($data);
        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $comment = Comment::create($data);
        // var_dump($objective->id);die();
        // return;
        if($comment===false){
            $array = array('msg'=>'发表评论失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'发表评论成功!','status'=>1);
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
