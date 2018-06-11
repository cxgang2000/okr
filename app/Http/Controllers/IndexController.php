<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            $array = array('msg'=>route("objective.mine_executor"),'status'=>1);
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

}
