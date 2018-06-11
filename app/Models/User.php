<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class User extends Model
{
    protected $table = 'user';

    protected $fillable=['name','phone','email','pwd','position_id','department_id','status','pid','isleader']; 

    public function pname()
    {
        return $this->hasOne('App\Models\User',"id","pid")->withDefault();
    }

    // public function department()
    // {
    //     return $this->hasOne('App\Models\Department');
    // }

    public function department()
    {
        return $this->belongsTo('App\Models\Department')->withDefault();
    }

    public function getDptLeader($arr_dptids)
    {
    	// $arr_where = ['isleader', '=', '1'];
     	// $arr_leader = $this->where($arr_where)->whereIn("department_id",$arr_dptids)->get("department_id","name");

    	// $arr_leader = $this->find(2);
    	// $arr_where = [
					//     ['id', '=', '2'],
					//     ['name', '=', '田峰'],
					// ];

		$arr_where = [
					    ['isleader', '=', '1'],
					];
    	$arr_leader = $this->select(['name','department_id'])->where($arr_where)->whereIn("department_id",$arr_dptids)->get()->toArray();
        return $arr_leader;
    }

    // hasLeader
    public function hasLeader($department_id,$user_id)
    {
		$arr_where = [
					    ['isleader', '=', '1'],
					    ['department_id', '=', $department_id],
					];
		// var_dump($arr_where);

    	$arr_leader = $this->where($arr_where)->get()->toArray();
    	// var_dump($arr_leader);die();
    	// var_dump(count($arr_leader));
    	

    	if(count($arr_leader)==0) return 0;
    	if(count($arr_leader)==1 && $arr_leader[0]['id']==$user_id){
    		return 0;
    	}else{
    		return 1;
    	}

    }


    // 取带部门的员工列表
    public function getAllUserDept()
    {
        $arr_status = [0,1];

        // 计算员工上级 1取所有部门 2取所有员工 2将员工放在部门下 4去掉没有员工的部门
        $arr_litedpt = array();
        $arr_alldpt = Department::select(['id','name'])->whereIn("status",$arr_status)->orderBy('id',"asc")->get()->toArray();
        // var_dump($arr_alldpt);die();
        $arr_alluser = User::select(['id','name','department_id'])->whereIn("status",$arr_status)->orderBy('id',"desc")->get()->toArray();
        // var_dump($arr_alluser);
        // die();

        for ($i=0; $i < count($arr_alldpt); $i++) { 
            for ($j=0; $j < count($arr_alluser); $j++) { 
                if($arr_alluser[$j]['department_id']==$arr_alldpt[$i]['id']){
                    $arr_alldpt[$i]['users'][]=$arr_alluser[$j];
                }
            }
        }
        // var_dump($arr_alldpt);die();
        // var_dump($arr_alldpt[0]['users']);die();

        for ($i=0; $i < count($arr_alldpt); $i++) { 
            if(isset($arr_alldpt[$i]['users'])){
                $arr_litedpt[]=$arr_alldpt[$i];
            }
        }

        // var_dump($arr_litedpt);die();
        // var_dump($arr_alldpt[2]['users']);die();
        // die();
        // 部门人员取出

        return $arr_litedpt;

    }
        
    

}
