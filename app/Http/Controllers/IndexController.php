<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class IndexController extends Controller
{
    public function create()
    {
        // return view('login/loginAdmin');
        return view('index.create');
    }

    public function store(Request $request)
    {
        // $credentials = $this->validate($request, [
        //     'name' => 'required|',
        //     'password' => 'required'
        // ]);

        // var_dump($_POST);

        $arr_where[] = ['status',0];
        $arr_where[] = ['phone',$request->name];
        $arr_where[] = ['pwd',md5($request->password)];
        // var_dump($arr_where);

        $user = User::where($arr_where)->get()->toArray();
        // var_dump($user);
        if(count($user)==0){
            // return 0;
            $array = array('msg'=>'用户未找到，登录失败!','status'=>0);
            return json_encode($array);
        }else{
            // return 1;
            session(['idUser' => $user[0]['id']]);
            //是不是也可以把user数组直接方session里
            $array = array('msg'=>route("objective.iamexecutor","1"),'status'=>1);
            return json_encode($array);
        }
    }


    public function logout(Request $request)
    {
        // dd($request->session()->all());
        $request->session()->forget('idUser');
        // dd(route('admin.login'));
        return redirect()->route('index.login');
    }


    public function changePwd(Request $request)
    {

        if (!$request->session()->has('idUser')) {
            $array = array('msg'=>"非登录用户！",'status'=>0);
            return json_encode($array);
        } 

        $rules = [
            // 'id' => 'required|integer',
            'oldpwd' => 'required|',
            'newpwd' => 'required|',
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

        $arr_where[] = ['status',0];
        $arr_where[] = ['id',session("idUser")];
        
        $item = User::where($arr_where)->first();

        // dd($item);

        // dd($item->pwd . " --- ".$request->oldpwd . "++++" .md5($request->oldpwd));

        if($item->pwd != md5($request->oldpwd)){
            $array = array('msg'=>'原始密码错误','status'=>0);
            return json_encode($array);
        }


        $item->pwd=md5($request->newpwd);
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'密码修改失败!','status'=>0);
            return json_encode($array);
        }else{
            $array = array('msg'=>'密码修改成功!','status'=>1);
            return json_encode($array);
        }
    }
}
