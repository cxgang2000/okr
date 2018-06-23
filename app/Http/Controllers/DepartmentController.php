<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Department;
use App\Models\User;
use Validator;

class DepartmentController extends Controller
{

	public function __construct()
    {
    	// die("aaa");

    	// $this->request = request();
 
        // 验证是否登录
        $this->middleware(function ($request, $next) {

        	// dd($request->session()->all());

            // if (!\Session::get('idAdmin')) {
        	// dd($request->session()->has('idAdmin'));
            if (!$request->session()->has('idAdmin')) {
                redirect('admin/login')->send();exit();
            }
             
            return $next($request);
        });



        // var_dump($request->session()->all());

    	// var_dump(session());
        // if(empty(session('idAdmin'))){
        // 	die("未登录");
        // }
    }


	public function index()
    {

    	/*
    	// $pid = Department::find(11)->pname;//可以找到上级部门的名字，但只是这一条记录的
    	// // $pid = Department::all();
    	// var_dump($pid);
    	// die();
    	// die("aaa");
		*/

    	/*
    	// 通过hasOne可以通过 n+1 个sql 得到结果
    	$department = Department::all();
    	// $department = Department::find(12);
    	// var_dump($department);//die();
    	foreach ($department as $one) {
    		// echo "aaa::";
    		$one->pname;//为one get 到了pname
    		// if(is_null($one->pname)){
    		// 	echo "没上级";
    		// }else{
    		// 	var_dump($one->pname->toArray()['name']);
    		// }
    		// var_dump($one->pname);
		    // echo $one->pname->name;
		    // die();
		}
		// var_dump($department->toArray());//die();
    	die();
    	*/

    	/* 通过with预加载得到了pname
    	$department = Department::with('pname')->get();
    	var_dump($department->toArray());die();
		// foreach ($department as $one) {
		// 	if(is_null($one->pname)){
		// 		echo "没上级";
		// 	}else{
		// 		var_dump($one->pname->toArray()['name']);
		// 	}
		// }
		die();
		*/

		// $department = Department::paginate(3);
		// var_dump($department->toArray());
		// $department->load('pname');
		// var_dump($department->toArray());
		// die();


    	// $department = Department::paginate(3);
    	// $department->load('pname');
    	// // var_dump($department);die();
    	// // var_dump($department->items());
    	// $di = $department->items();
    	// // var_dump($di);die();
    	// for ($i=0; $i < count($di); $i++) { 
    	// 	// var_dump($di[$i]->toArray());
    	// 	$arr_dpt[] = $di[$i]->toArray(); 
    	// }
    	// var_dump($arr_dpt);
    	// for ($i=0; $i < count($arr_dpt); $i++) { 
    	// 	// $arr_dpt[$i]['pname'] = 
    	// }

    	// die();

		// $arr_status = [0,1];
  		// $department = Department::where('id', '>', 10)->where('id', '<', 130)->whereIn("status",$arr_status)->paginate(10)->toArray();
  		// var_dump($department);die();

		// die();

		$perPage = 5;
		$arr_status = [0,1];
        $department = Department::whereIn("status",$arr_status)->orderBy('id',"desc")->paginate($perPage);
        $department->load('pname');
        // var_dump($department);die();
        // $department->load('user');
        // var_dump($department->toArray());die();
        // dd($department->currentPage);


        // var_dump($department->toArray()['data']);die();


        // 本页所有部门id，为了找领导用
        $arr_dpt = $department->toArray()['data'];
        if(count($arr_dpt)!=0){
	        foreach ($arr_dpt as $v) {
	        	$arr_dptids[] = $v['id'];
	        }
	        // var_dump($arr_dptids);//die();
	        $user = new User;
	        $arr_leader = $user->getDptLeader($arr_dptids);
	        // var_dump($arr_leader);//die();
	        for ($i=0; $i < count($arr_dpt); $i++) {
	        	$arr_dpt[$i]['leader'] = "";
	        	for ($j=0; $j < count($arr_leader); $j++) { 
	        		if($arr_dpt[$i]['id']==$arr_leader[$j]['department_id']){
	        			$arr_dpt[$i]['leader']=$arr_leader[$j]['name'];
	        			break;
	        		}
	        	}
	        }
	    }
        // var_dump($arr_dpt);die();




        // 取所有部门 显示上级部门用 只显示有效的，停用的删除的都不要
        $arr_where_status0['status'] = 0;
        $arr_all_dpt = Department::where($arr_where_status0)->orderBy('id',"asc")->get();
        
        return view('department.index',compact('department','arr_all_dpt','arr_dpt'));
    }

    public function destroy(Department $department)
    {

    	// 需要增加的逻辑
    	// 1.此部门不是有效部门（启用或停用，非删除）的父部门
    	// 2.此部门下没有员工


        $arr_user = Department::find($department->id)->user()->get()->toArray();
        // dd($arr_user);
        if(count($arr_user)>0){
            session()->flash('del_department', '此部门下已有员工，不能删除');
            return back();
        }

        $hasChildren = Department::hasChildren($department->id);
        // dd($hasChildren);
        if($hasChildren==1){
            session()->flash('del_department', '此部门已作为有效部门的上级部门，不能删除');
            return back();
        }

        if($department->delete()){
            // return Redirect::back()->with('message', '成功删除用户！');
            session()->flash('del_department', '删除部门成功！');
        }else{
            // return Redirect::back()->withInput()->with('errors','删除用户失败！');
            session()->flash('del_department', '删除部门失败！');
        } 

        
	    return back();
    }

    public function edit(Department $department)
    {
        // var_dump($department->toArray());
        // return $department->toArray();
        return json_encode($department->toArray());
    }

    public function update(Department $department, Request $request)
    {
    	// var_dump("update");die();
    	// return json_encode("update");
        $rules = [
            'name' => 'required|unique:department,name,'.$department->id.'|max:50',
            // 'name' => 'required|max:50',
            'pid' => 'required|integer',
            // 'status' => 'required',Rule::in(["0","1"]),
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
        $data['pid'] = $request->pid;
        $data['status'] = $request->status;

        $department->update($data);

        if($department===false){
	        $array = array('msg'=>'编辑部门失败!','status'=>0);
			return json_encode($array);
        }else{
	        $array = array('msg'=>'编辑部门成功!','status'=>1);
			return json_encode($array);
        }
    }

    // public function list()
    // {
    //     return view('department/list');
    // }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:department|max:50',
        //     'pid' => 'required|integer',
        //     'status' => 'required',Rule::in(["0","1"]),
        // ]);

    	$rules = [
            'name' => 'required|unique:department|max:50',
            'pid' => 'required|integer',
            // 'status' => 'required',Rule::in(["0","1"]),
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

                if($v[0]=="名称 已经存在。" || $v[0]=="The name has already been taken."
                    ){$v[0]="部门名称重复，请重新输入";}

	        	$str_err = $str_err . $v[0]."<br>";
	        }
	        $array = array('msg'=>$str_err,'status'=>0);
			return json_encode($array);
        }


        $data['name'] = $request->name;
        $data['pid'] = $request->pid;
        $data['status'] = $request->status;
        
        // var_dump($data);die();

        $department = Department::create($data);
		// var_dump($department);die();
        // return;

        if($department===false){
        	// return Redirect::back()->withInput()->withErrors('保存失败！');
        	// return response()->json(array(
	        //     'status' => 0,
	        //     'msg' => 'fail',
	        // ));
	        $array = array('msg'=>'新增部门失败!','status'=>0);
			return json_encode($array);
        }else{
        	// return response()->json(array(
	        //     'status' => 1,
	        //     'msg' => 'ok',
	        // ));

	        $array = array('msg'=>'新增部门成功!','status'=>1);
			return json_encode($array);
        	
        }
    }
}
