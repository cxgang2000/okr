<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function create()
    {
        // return view('login/loginAdmin');
        return view('admin.create');
    }

    public function store(Request $request)
    {
		// $credentials = $this->validate($request, [
		//     'name' => 'required|',
		//     'password' => 'required'
		// ]);

    	// var_dump($_POST);
       	
       	$arr_where[] = ['name',$request->name];
       	$arr_where[] = ['password',md5($request->password)];
       	// var_dump($arr_where);
       	
       	$admin = Admin::where($arr_where)->get()->toArray();
       	// var_dump($admin);
       	if(count($admin)==0){
       		// return 0;
       		$array = array('msg'=>'用户未找到，登录失败!','status'=>0);
			return json_encode($array);
       	}else{
       		// return 1;
       		session(['idAdmin' => $admin[0]['id']]);
       		$array = array('msg'=>route("department.index"),'status'=>1);
			return json_encode($array);
       	}
    }


    public function logout(Request $request)
    {
		// dd($request->session()->all());
		$request->session()->forget('idAdmin');
		// dd(route('admin.login'));
		return redirect()->route('admin.login');
    }

}
