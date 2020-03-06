<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'user';

    protected $fillable=['name','phone','email','pwd','position_id','department_id','status','pid','isleader']; 

    public static $arr_position = array(
        1=>'CEO',
        2=>'副总裁',
        3=>'分校校长',
        4=>'分校副校长',
        5=>'CEO助理',
        6=>'部门主管',
        7=>'部门副主管',
        8=>'产品经理',
        9=>'初中化学研究员',
        10=>'初中数学研究员',
        11=>'高中数学教师',
        12=>'高中物理教师',
        13=>'高中化学教师',
        14=>'英语教师',
        15=>'招聘主管',
        16=>'HR主管',
        17=>'HR',
        18=>'财务',
        19=>'行政主管',
        20=>'工程监理',
        21=>'网络客服课长',
        22=>'新媒体运营',
        23=>'新媒体运营课长',
        24=>'教学管理',
        25=>'客户专员',
        26=>'校区主管',
        27=>'教研专员',
        28=>'客户课长',
        // 1=>'老师',
        // 2=>'人事专员',
        // 3=>'招聘专员',
        // 4=>'人事主管',
        // 5=>'新媒体运营',
        // 6=>'用户运营',
        // 7=>'活动策划',
        // 8=>'网络运营主管',
        // 9=>'研发主管',
        // 10=>'产品经理',
        // 11=>'开发工程师',
        // 12=>'前端工程师',
        // 13=>'测试工程师',
        // 14=>'UI设计师',
        // 15=>'CEO助理',
        // 16=>'财务主管',
        // 17=>'账簿与税务会计',
        // 18=>'成本与预算会计',
        // 19=>'资金会计',
        // 20=>'品牌主管',
        // 21=>'平面设计',
        // 22=>'新媒体运营',
        // 23=>'视频剪辑',
        // 24=>'行政主管',
        // 25=>'行政专员',
        // 26=>'呼叫主管',
        // 27=>'呼叫专员',
        // 28=>'校区行政',
        // 29=>'客服',
        // 30=>'分校校长',
        // 31=>'CEO',
        ); 

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
    public function getAllUserDept($keyword="")
    {
        // $arr_status = [0,1];
        $arr_where['status'] = 0;

        // 计算员工上级 1取所有部门 2取所有员工 2将员工放在部门下 4去掉没有员工的部门
        $arr_litedpt = array();
        // $arr_alldpt = Department::select(['id','name'])->whereIn("status",$arr_status)->orderBy('id',"asc")->get()->toArray();
        $arr_alldpt = Department::select(['id','name'])->where($arr_where)->orderBy('id',"asc")->get()->toArray();
        
        // var_dump($arr_alldpt);die();
        
        if($keyword!=""){
            $arr_alluser = User::select(['id','name','department_id','position_id'])
            ->where($arr_where)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('phone', 'like', "%{$keyword}%");
                })
            ->orderBy('id',"desc")
            ->get()
            ->toArray();
        }else{
            $arr_alluser = User::select(['id','id as userid','name','department_id','position_id'])->where($arr_where)
                ->orderBy('id',"desc")
                ->get()->toArray();
        }
        
        // var_dump($arr_alluser);
        // die();
        // dd($this->arr_position);
        $arr_position = $this::$arr_position;
        // var_dump($arr_position);

        // 取职位
        for ($j=0; $j < count($arr_alluser); $j++) {
            // echo $arr_alluser[$j]['position_id'];
            // echo "<br>";
            $arr_alluser[$j]['position_name']=$arr_position[$arr_alluser[$j]['position_id']];
        }
        // dd($arr_alluser);

        // 取部门
        for ($i=0; $i < count($arr_alldpt); $i++) { 
            for ($j=0; $j < count($arr_alluser); $j++) {
                if($arr_alluser[$j]['department_id']==$arr_alldpt[$i]['id']){
                    $arr_alldpt[$i]['users'][]=$arr_alluser[$j];
                }
            }
            // $arr_alluser[$j]['position_name'] = $arr_position[$arr_alluser[$j]['position_id']];
            // echo $arr_alldpt[$i]['position_id'];
        }
        // var_dump($arr_alldpt);die();
        // var_dump($arr_alldpt[0]['users']);die();

        // 去掉没有员工的部门
        for ($i=0; $i < count($arr_alldpt); $i++) { 
            if(isset($arr_alldpt[$i]['users'])){
                $arr_litedpt[]=$arr_alldpt[$i];
            }
        }

        // var_dump($arr_litedpt);die();
        // var_dump($arr_alldpt[2]['users']);die();
        // die();
        // 部门人员取出

        // dd($arr_litedpt);

        // for ($i=0; $i < count($arr_litedpt); $i++) { 
        //     $arr_litedpt[$i]['dptid'] = $arr_litedpt[$i]['id'];
        //     unset($arr_litedpt[$i]['id']);
        // }
        // dd($arr_litedpt);

        return $arr_litedpt;
    }
    
    // 取带部门的员工列表
    public function getAllUserDept1($keyword="")
    {
        // $arr_status = [0,1];
        $arr_where['status'] = 0;

        // 计算员工上级 1取所有部门 2取所有员工 2将员工放在部门下 4去掉没有员工的部门
        $arr_litedpt = array();
        // $arr_alldpt = Department::select(['id','name'])->whereIn("status",$arr_status)->orderBy('id',"asc")->get()->toArray();
        $arr_alldpt = Department::select(['id','name','pId'])->where($arr_where)->orderBy('id',"asc")->get()->toArray();
        
        // return $arr_alldpt;
        // var_dump($arr_alldpt);die();
        
        if($keyword!=""){
            $arr_alluser = User::select(['id as userid','name','department_id as pId','position_id'])
            ->where($arr_where)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('phone', 'like', "%{$keyword}%");
                })
            ->orderBy('id',"asc")
            ->get()
            ->toArray();
        }else{
            $arr_alluser = User::select(['id as userid','name','department_id as pId','position_id'])->where($arr_where)
                ->orderBy('id',"asc")
                ->get()->toArray();
        }
        
        // var_dump($arr_alluser);
        // die();
        // dd($this->arr_position);
        $arr_position = $this::$arr_position;
        // var_dump($arr_position);

        // 取职位
        for ($j=0; $j < count($arr_alluser); $j++) {
            // echo $arr_alluser[$j]['position_id'];
            // echo "<br>";
            $arr_alluser[$j]['position_name']=$arr_position[$arr_alluser[$j]['position_id']];
            $arr_alluser[$j]['id']=$arr_alluser[$j]['pId']."_".$arr_alluser[$j]['userid'];
            // $arr_alluser[$j]['id']=$arr_alluser[$j]['pId']+$arr_alluser[$j]['userid'];
            
        }
        // dd($arr_alluser);

        // // 取部门
        // for ($i=0; $i < count($arr_alldpt); $i++) { 
        //     for ($j=0; $j < count($arr_alluser); $j++) {
        //         if($arr_alluser[$j]['department_id']==$arr_alldpt[$i]['id']){
        //             $arr_alldpt[$i]['users'][]=$arr_alluser[$j];
        //         }
        //     }
        //     // $arr_alluser[$j]['position_name'] = $arr_position[$arr_alluser[$j]['position_id']];
        //     // echo $arr_alldpt[$i]['position_id'];
        // }
        // // var_dump($arr_alldpt);die();
        // // var_dump($arr_alldpt[0]['users']);die();

        // // 去掉没有员工的部门
        // for ($i=0; $i < count($arr_alldpt); $i++) { 
        //     if(isset($arr_alldpt[$i]['users'])){
        //         $arr_litedpt[]=$arr_alldpt[$i];
        //     }
        // }

        $arr_litedpt = array_merge($arr_alluser,$arr_alldpt);
        // dd($arr_litedpt);
        // var_dump($arr_litedpt);
        // die();

        return $arr_litedpt;
    }

    public static function findUser($user_id)
    {
        $user = User::find($user_id);
        $user['position_name'] = User::$arr_position[$user['position_id']];
        return $user;
    }


    public static function getLeaderIdByUserId($userid)
    {

        $user = DB::select('select * from user where isleader=1 and department_id=( SELECT department_id FROM `user` WHERE id=:id ) limit 1', [':id'=>$userid]);
        $data = array_map('get_object_vars', $user);
        if(empty($data)){
            return [];
        }else{
            return $data[0];
        }
    }
}
