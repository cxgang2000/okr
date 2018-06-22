<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Department;

use Validator;

class UserController extends Controller
{

    public function __construct()
    {
 
        // 验证是否登录
        $this->middleware(function ($request, $next) {
            if (!$request->session()->has('idAdmin')) {
                redirect('admin/login')->send();exit();
            }             
            return $next($request);
        });
    }

	// public $arr_position = array(
	// 	1=>'CEO',
	// 	2=>'CFO',
	// 	3=>'COO',
	// 	4=>'助理',
	// 	5=>'出纳',
	// 	6=>'霸道保洁',
	// 	7=>'牛逼小二',
	// 	); 

	// public $arr_dpt_usr = array(
	// 	0 => array(
	// 		'id'=>'1',
	// 		'name'=>'dpt1',
	// 		'user'=>array(
	// 			0 => array(
	// 				'id'=>1,
	// 				'name'=>'user1',
	// 				),
	// 			1 => array(
	// 				'id'=>2,
	// 				'name'=>'user2',
	// 				),
	// 			),
	// 		),

	// 	1 => array(
	// 		'id'=>'2',
	// 		'name'=>'dpt2',
	// 		'user'=>array(
	// 			0 => array(
	// 				'id'=>3,
	// 				'name'=>'user3',
	// 				),
	// 			1 => array(
	// 				'id'=>4,
	// 				'name'=>'user4',
	// 				),
	// 			),
	// 		),

	// 	); 

	public function index(Request $request)
    {
    	// $aaa = User::find(2);
    	// // var_dump($aaa);
    	// // $aaa->load('pname');
    	// $bbb = $aaa->load('department')->toArray();
    	
    	// var_dump($bbb);
    	// die();

    	// $a = $this->arr_dpt_usr;
    	// var_dump($a);die();

    	$arr_status = [0,1];

        // 带部门的员工列表
        $tmpUser = new User;
    	$arr_allUserDept = $tmpUser->getAllUserDept();

    	// 取列表数据
    	$perPage = 5;
		$arr_status = [0,1];
		$phoneorname = $request->phoneorname;
		if (!empty($phoneorname)) {
		    // die("ppppp");
		    $user = User::where(function ($query) use ($phoneorname) {
		        $query->where('name', 'like', "%{$phoneorname}%")->orWhere('phone', 'like', "%{$phoneorname}%");
		    })->orderBy('id',"desc")->paginate($perPage);

		}else{
			// die("qqqq");
			$user = User::whereIn("status",$arr_status)->orderBy('id',"desc")->paginate($perPage);
		}
		// 为每个user添加部门
        $user->load('pname','department');
        // $user->load('pname','department');
        // $user->load('department');
        // var_dump($user->toArray());die();


        // 所有部门
        $all_dpt = Department::whereIn("status",$arr_status)->orderBy('id',"asc")->get();

        // var_dump($this->arr_position);die();

        // 所有职位
        // $arr_position = $this->arr_position;
        $arr_position = User::$arr_position;
        
        // 模板 传参
        return view('user.index',compact('user','all_dpt','arr_position','arr_allUserDept','phoneorname'));
    }

    public function destroy(User $user)
    {

    	// 需要增加的逻辑
    	// 1.此部门不是有效部门的父部门
    	// 2.词部门下没有员工
        if($user->delete()){
	        // return Redirect::back()->with('message', '成功删除用户！');
	        session()->flash('del_user', '成功删除用户！');
	    }else{
	        // return Redirect::back()->withInput()->with('errors','删除用户失败！');
	        session()->flash('del_user', '删除用户失败！');
	    }
	    return back();
    }

    public function edit(User $user)
    {
        // var_dump($user->toArray());
        // return $user->toArray();
        return json_encode($user->toArray());
    }

    public function update(User $user, Request $request)
    {
    	// var_dump("update");die();
    	// return json_encode("update");
    	// var_dump($_POST);die();
        $rules = [
            'name' => 'required|unique:user,name,'.$user->id.'|max:50',
            'phone' => 'required|unique:user,phone,'.$user->id.'|digits_between:11,11',
            'email' => 'required|email',
            'position_id' => 'required|',
            'department_id' => 'required|',
            'pid' => 'required|',
            'status' => 'required|integer',
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

        // $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['position_id'] = $request->position_id;
        $data['department_id'] = $request->department_id;
        $data['isleader'] = $request->isleader;
        $data['pid'] = $request->pid;
        $data['status'] = $request->status;

        // 判断是否此部门已经有了leader，有了需要提示不能设置此人为leader
        if($data['isleader']=="1"){
            $tmpUser = new User;
            $hasLeader = $tmpUser->hasLeader($request->department_id,0);
            if($hasLeader){
                $str_err = "此部门已经有位领导！";
                $array = array('msg'=>$str_err,'status'=>0);
                return json_encode($array);
            }
        }


        $user->update($data);

        if($user===false){
	        $array = array('msg'=>'编辑员工失败!','status'=>0);
			return json_encode($array);
        }else{
	        $array = array('msg'=>'编辑员工成功!','status'=>1);
			return json_encode($array);
        }
    }

    // public function list()
    // {
    //     return view('user/list');
    // }

    public function store(Request $request)
    {
    	// var_dump($_POST);die();
    	$rules = [
            'name' => 'required|unique:user|max:50',
            'phone' => 'required|unique:user|digits_between:11,11',
            'email' => 'required|email',
            'position_id' => 'required|',
            'department_id' => 'required|',
            'pid' => 'required|',
            'status' => 'required|integer',
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


        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['position_id'] = $request->position_id;
        $data['department_id'] = $request->department_id;
        $data['isleader'] = $request->isleader;
        
        $data['pid'] = $request->pid;
        $data['status'] = $request->status;
        $data['pwd'] = md5($request->phone);
        
        // 判断是否此部门已经有了leader，有了需要提示不能设置此人为leader
        if($data['isleader']=="1"){
            $tmpUser = new User;
            $hasLeader = $tmpUser->hasLeader($request->department_id,0);
            if($hasLeader){
                $str_err = "此部门已经有位领导！";
                $array = array('msg'=>$str_err,'status'=>0);
                return json_encode($array);
            }
        }
        
        // var_dump($data);die();

        $user = User::create($data);
		// var_dump($user);die();
        // return;

        if($user===false){
        	
	        $array = array('msg'=>'新增员工失败!','status'=>0);
			return json_encode($array);
        }else{
	        $array = array('msg'=>'新增员工成功!','status'=>1);
			return json_encode($array);
        	
        }
    }

    // 启用或停用
    public function editstatus(User $user, Request $request)
    {
        $rules = [
            'status' => 'required|integer',
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
        
        $data['status'] = $request->status;
        // var_dump($data);die();
        $user->update($data);

        if($user===false){
	        $array = array('msg'=>'编辑失败!','status'=>0);
			return json_encode($array);
        }else{
	        $array = array('msg'=>'编辑成功!','status'=>1);
			return json_encode($array);
        }
    }

    // 启用或停用
    public function resetpwd(User $user)
    {

    	$data['pwd'] = md5($user->phone);

        $user->update($data);

        if($user===false){
	        $array = array('msg'=>'重置密码失败!','status'=>0);
			return json_encode($array);
        }else{
	        $array = array('msg'=>'重置密码成功!','status'=>1);
			return json_encode($array);
        }
    }




    public function test(Request $request)
    {
    	echo "test";

    	$user = new User;
    	$user = $user->hasLeader(32);
    }
}
