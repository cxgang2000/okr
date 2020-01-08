<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Department;
use App\Models\Objective;
use App\Models\Mission;
use App\Models\Plan;
use App\Models\Stateindex;
use App\Models\Objectivelog;

use Illuminate\Support\Facades\DB;

use Validator;

class ObjectiveController extends Controller
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

    
    public function iamexecutor(Request $request,$p1)
    {

        $arr_period = array();
        $perioditem = $request->perioditem;
        if($perioditem=="")$perioditem="week";
        $period = $request->period;
        if($period=="")$period=1;
        
        if($perioditem!="others"){
            $arr_period = $this->getDate($period);
            $arr_period[0] = substr($arr_period[0], 0,10);
            $arr_period[1] = substr($arr_period[1], 0,10);
        }else{
            $arr_period = explode(" - ",$period);
        }
        // dd($arr_period);

        // die();

        // 取负责人名字
        $executor_id = session('idUser');
        // $executor = User::findUser($executor_id)->toArray();
        $executor = User::find($executor_id)->toArray();
        
        // dd($executor);

        // 目标列表
        $perPage = 10;

        // 我负责的
        if($p1==1){
            $templateName = "index.iamexecutor";

            $arr_where['executor_id'] = $executor_id;
            $arr_where['status'] = 0;
            
            // 取目标
            $objective = Objective::where($arr_where)
                ->where(function ($query) use ($arr_period) {
                    $query->where(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                            })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                                })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                            });
                    })
                ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
        }

        // 我参与的
        if($p1==2){
            $templateName = "index.iampartake";

            // 我参与的目标id集合
            $arr_where_partake = [['user_id', '=', $executor_id],['okr_id', '<', '10000000'],];
            $arr_partake = Partake::where($arr_where_partake)->get(['okr_id'])->toArray();
            // dd($arr_partake);
            $arr_where['status'] = 0;

            // 取目标
             $objective = Objective::where($arr_where)
                ->whereIn("id",$arr_partake)
                ->where(function ($query) use ($arr_period) {
                    $query->where(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                            })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                                })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                            });
                    })
                ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
        }

        // 我发起的
        if($p1==3){
            $templateName = "index.iamorganiser";

            $arr_where['organiser_id'] = $executor_id;
            $arr_where['status'] = 0;
            
            // 取目标
            $objective = Objective::where($arr_where)
                ->where(function ($query) use ($arr_period) {
                    $query->where(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                            })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                                })
                            ->orWhere(function ($query) use ($arr_period) {
                                $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                            });
                    })
                ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
        }
        
        // 取下面的关键结果
        $objective->load("keyresults");
        // dd($objective->toArray());
        // $objective = Objective::where($arr_where)->keyresults()->get();
        // dd($objective->toArray());

        // var_dump($objective->toArray()['data']);
        // 拼所有的关键结果id
        $arr_krids = array();
        $arr_objective = $objective->toArray()['data'];
        for ($i=0; $i < count($arr_objective); $i++) { 
            for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) { 
                $arr_krids[] = $arr_objective[$i]['keyresults'][$j]['id'];
            }
        }
        // var_dump($arr_krids);
        // 取这些关键结果下的计划，有效的status=0
        $arr_where_plan[] = ['status',0];
        $arr_plan = Plan::where($arr_where_plan)->whereIn("pid",$arr_krids)->orderBy('id',"desc")->get(['id', 'name', 'startdate', 'enddate', 'score', 'scoretime', 'pid'])->toArray();
        // dd($arr_plan);die();

        // 拼一起
        $today = date("Y-m-d");
        for ($i=0; $i < count($arr_objective); $i++) {
            // $arr_objective[$i]['cj']=1;
            $arr_objective[$i]['flag']="objective";
            // $arr_objective[$i]['open']=false;
            $arr_objective[$i]['canDel']=0;
            $arr_objective[$i]['canScore']=0;
            $arr_objective[$i]['kr_count']="0/0";

            // 状态标记
            $arr_objective[$i]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['startdate'],$arr_objective[$i]['enddate'],$arr_objective[$i]['score'],$arr_objective[$i]['scoretime']);

            // // 未开始的能删
            // if($arr_objective[$i]['dateStatus']==1){$arr_objective[$i]['canDel']=1;}
            // // 没下级的能删
            // if(count($arr_objective[$i]['keyresults'])==0){$arr_objective[$i]['canDel']=1;}
            $kr_count = 0;
            $kr_done_count = 0;
            for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) {
                $kr_count++;
                // $arr_objective[$i]['keyresults'][$j]['cj']=2;
                $arr_objective[$i]['keyresults'][$j]['flag']="keyresult";
                // $arr_objective[$i]['keyresults'][$j]['open']=false;
                $arr_objective[$i]['keyresults'][$j]['canScore']=0;
                $arr_objective[$i]['keyresults'][$j]['plan_count']="0/0";
                

                // 状态标记
                $arr_objective[$i]['keyresults'][$j]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['keyresults'][$j]['startdate'],$arr_objective[$i]['keyresults'][$j]['enddate'],$arr_objective[$i]['keyresults'][$j]['score'],$arr_objective[$i]['keyresults'][$j]['scoretime']);

                if($arr_objective[$i]['keyresults'][$j]['dateStatus']==3 or $arr_objective[$i]['keyresults'][$j]['dateStatus']==4){
                    $kr_done_count++;
                }
                $arr_objective[$i]['kr_count']=$kr_done_count."/".$kr_count;
               
                // $arr_objective[$i]['keyresults'][$j]['dateStatus'] = 4;
                $plan_count = 0;
                $plan_done_count = 0;
                for ($k=0; $k < count($arr_plan); $k++) {
                    if($arr_plan[$k]['pid']==$arr_objective[$i]['keyresults'][$j]['id']){
                        // echo "add before:".$plan_count;
                        $plan_count++;
                        // echo "add after:".$plan_count;
                        // echo "<br>";
                        // $arr_plan[$k]['cj']=3;
                        $arr_plan[$k]['flag']="plan";
                        
                        // 状态标记
                        $arr_plan[$k]['dateStatus'] = Objective::getDateStatus($arr_plan[$k]['startdate'],$arr_plan[$k]['enddate'],$arr_plan[$k]['score'],$arr_plan[$k]['scoretime']);
                        // echo $arr_plan[$k]['dateStatus'];
                        if($arr_plan[$k]['dateStatus']==3 or $arr_plan[$k]['dateStatus']==4){
                            $plan_done_count++;
                        }
                        // （进行中的或已逾期未评分的）且（下级完成数==总数的）可以评分
                        if(($arr_plan[$k]['dateStatus']==2 || ($arr_plan[$k]['dateStatus']==4 && $arr_plan[$k]['score']==999))){
                            $arr_plan[$k]['canScore']=1;
                        }else{
                            $arr_plan[$k]['canScore']=0;
                        }

                        $arr_objective[$i]['keyresults'][$j]['plan_count']=$plan_done_count."/".$plan_count;
                        
                        $arr_objective[$i]['keyresults'][$j]['plans'][]=$arr_plan[$k];
                    }
                }

                $arr_objective[$i]['keyresults'][$j]['name'] = $arr_objective[$i]['keyresults'][$j]['name'] . "(".$arr_objective[$i]['keyresults'][$j]['plan_count'].")";

                // （进行中的或已逾期未评分的）且（下级完成数==总数的）可以评分
                if(($arr_objective[$i]['keyresults'][$j]['dateStatus']==2 || ($arr_objective[$i]['keyresults'][$j]['dateStatus']==4 && $arr_objective[$i]['keyresults'][$j]['score']==999)) && ($plan_count==$plan_done_count)){
                    $arr_objective[$i]['keyresults'][$j]['canScore']=1;
                }
            }

            // （进行中的或已逾期未评分的）且（下级完成数==总数的）可以评分
            if(($arr_objective[$i]['dateStatus']==2 || ($arr_objective[$i]['dateStatus']==4 && $arr_objective[$i]['score']==999)) && ($kr_count==$kr_done_count)){
                $arr_objective[$i]['canScore']=1;
            }

            // 改写标题，加入下级完成状态计数
            $arr_objective[$i]['name'] = $arr_objective[$i]['name'] . "(".$arr_objective[$i]['kr_count'].")";
        }
        // dd($arr_objective);

        // foreach ($arr_objective as $o) {
            
        // }

        // 转换成json前台js用
        $json_objective = json_encode($arr_objective,JSON_UNESCAPED_UNICODE);
        // 替换key为要求名字
        $json_objective = str_replace("keyresults", "children", $json_objective);
        $json_objective = str_replace("plans", "children", $json_objective);
        // dd($json_objective);

        // dd($p1);

        // die();

        // 带部门的员工列表
        $tmpUser = new User;
        $arr_allUserDept = $tmpUser->getAllUserDept();

        
        return view($templateName,compact('arr_allUserDept', 'json_objective', 'objective', 'executor', 'executor_id', 'perioditem', 'period', 'arr_period','p1'));
    }

    private function getWeekStartAndEnd($weekdate){
        $sdefaultDate = $weekdate;
        //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
        $first=1;
        //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $w=date('w',strtotime($sdefaultDate));
        //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        $week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days'))." 00:00:00";
        //本周结束日期
        $week_end=date('Y-m-d',strtotime("$week_start +6 days"))." 23:59:59";
        // dd([$week_start,$week_end]);
        return([$week_start,$week_end]);
    }

    // 我的okr
    public function mine(Request $request)
    {

        $durationflag = $request->durationflag;
        if ($durationflag=="") {$durationflag=1;}//默认打开季度
        $duration = $request->duration;
        $weekdate = $request->weekdate;
        if($weekdate=="")$weekdate=date("Y-m-d");
        $arr_weekSatrtAndEnd = $this->getWeekStartAndEnd($weekdate);
        
        // echo ($duration);

        // 季度下面的标签
        if ($duration=="") {
            // $month=date("m");
            // dd(date("m")<"7");
            // if(date("m")<"7")$duration="001";
            // if(date("m")>="7")$duration="002";
            // 半年度的默认

            // 季度的默认
            if(date("m")>="3" and date("m")<="5")$duration="1";
            if(date("m")>="6" and date("m")<="8")$duration="2";
            if(date("m")>="9" and date("m")<="11")$duration="3";
            if(date("m")=="12" or date("m")=="1" or date("m")=="2")$duration="4";
        }
        // dd($duration);
        

        $arr_where['durationflag'] = $durationflag;
        // if($arr_where['durationflag']==3){
        //     $duration1 = date("Y").$duration;
        // }else{
        //     $duration1 = $duration;
        // }
        if($arr_where['durationflag']==1){
            $duration1 = date("Y").$duration;
        }else{
            $duration1 = $duration;
        }
        $arr_where['duration'] = $duration1;

        // echo $arr_where['$arr_where'];
        // var_dump($arr_where);
        // die();

        $arr_where['organiser_id'] = session('idUser');
        $arr_where['status'] = 0;

        // var_dump($arr_where);die();
        $json_objective = $this->getObject($arr_where);
        $arr_stateindex = $this->getStateindex($arr_where);


        // 取目标和去计划与duration无关，只和人与星期有关
        $arr_where = array();
        $arr_where['status'] = 0;
        $arr_where['organiser_id'] = session('idUser');
        // dd($arr_where);

        $arr_mission = $this->getMission($arr_where,$arr_weekSatrtAndEnd[0],$arr_weekSatrtAndEnd[1]);
        $arr_plan = $this->getPlan($arr_where,$arr_weekSatrtAndEnd[0],$arr_weekSatrtAndEnd[1]);



        // 取上级领导的相关
        $myId = session('idUser');
        $arr_my = User::find($myId);
        // if($arr_my->pid!=""){
        $arr_others = User::find($arr_my->pid)->toArray();
        $arr_others['position_name']=User::$arr_position[$arr_others['position_id']];
        // dd($arr_others);

        $others_arr_where['duration'] = $duration1;
        $others_arr_where['organiser_id'] = $arr_others['id'];
        $others_arr_where['status'] = 0;
        // var_dump($others_arr_where);
        // dd("aaaa");

        if($arr_others['id']==""){

            $others_all['json_objective'] = '';
            $others_all['arr_mission'] = array();
            $others_all['arr_plan'] = array();
            $others_all['arr_stateindex'] = array();
        }else{


            $others_all['json_objective'] = $this->getObject($others_arr_where);
            $others_all['arr_stateindex'] = $this->getStateindex($others_arr_where);

            // $others_all['arr_mission'] = $this->getMission($others_arr_where);
            // $others_all['arr_plan'] = $this->getPlan($others_arr_where);

            $others_arr_where = array();
            $others_arr_where['status'] = 0;
            $others_arr_where['organiser_id'] = $arr_others['id'];
            // dd($others_arr_where);\
            // var_dump($others_arr_where);

            $others_all['arr_mission'] = $this->getMission($others_arr_where,$arr_weekSatrtAndEnd[0],$arr_weekSatrtAndEnd[1]);
            // var_dump($others_all['arr_mission']);
            // dd("aa");
            $others_all['arr_plan'] = $this->getPlan($others_arr_where,$arr_weekSatrtAndEnd[0],$arr_weekSatrtAndEnd[1]);
            }


        // dd($others_all);






        return view('index.mine33
            ',compact('durationflag', 'duration', 'weekdate', 'json_objective','arr_mission','arr_plan','arr_stateindex','arr_weekSatrtAndEnd','others_all','arr_others'));
    }

    // 取符合条件的O
    private function getObject($arr_where){
        // 取目标
        $objective = Objective::where($arr_where)->get();
        // var_dump($objective);
        // var_dump($arr_where);
        // dd($objective);

        // 取下面的关键结果
        $objective->load("keyresults");
        $arr_objective=$objective->toArray();
        
        // dd($arr_objective);

        for ($i=0; $i < count($arr_objective); $i++) {
            // $arr_objective[$i]['cj']=1;
            $arr_objective[$i]['flag']="objective";
            // $arr_objective[$i]['open']=false;
            $arr_objective[$i]['canDel']=0;
            $arr_objective[$i]['kr_count']="0/0";

            // $arr_objective[$i]['description']=htmlspecialchars_decode($arr_objective[$i]['description'],ENT_QUOTES);

            // // 未开始的能删
            // if($arr_objective[$i]['dateStatus']==1){$arr_objective[$i]['canDel']=1;}
            // // 没下级的能删
            // if(count($arr_objective[$i]['keyresults'])==0){$arr_objective[$i]['canDel']=1;}
            $kr_count = 0;
            $kr_done_count = 0;
            for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) {
                $kr_count++;
                // $arr_objective[$i]['keyresults'][$j]['cj']=2;
                $arr_objective[$i]['keyresults'][$j]['flag']="keyresult";
                // $arr_objective[$i]['keyresults'][$j]['open']=false;
                $arr_objective[$i]['keyresults'][$j]['canDel']=0;
                if($arr_objective[$i]['keyresults'][$j]['score']==999){
                    $arr_objective[$i]['keyresults'][$j]['canDel']=1;
                }else{
                    $kr_done_count++;
                }

                // if($arr_objective[$i]['keyresults'][$j]['score']!=999){
                //     $score = $arr_objective[$i]['keyresults'][$j]['score']."分 / ";
                // }else{
                //     $score = "";
                // }
                $number = "KR".($j+1).":";
                $arr_objective[$i]['keyresults'][$j]['name'] = $number.$arr_objective[$i]['keyresults'][$j]['description'];

            }
            $arr_objective[$i]['kr_count']=$kr_done_count."/".$kr_count;

            // 没有关键结果，就可以删除
            if($kr_count==0){
                $arr_objective[$i]['canDel']=1;
            }

            // 改写标题，加入得分、序号等
            // if($arr_objective[$i]['score']!=999){
            //     $score = $arr_objective[$i]['score']."分 / ";
            // }else{
            //     $score = "";
            // }
            $number = "O".($i+1).":";
            $arr_objective[$i]['name'] = $number.$arr_objective[$i]['description'] . "(".$arr_objective[$i]['kr_count'].")";
            $arr_objective[$i]['name'] = $number.$arr_objective[$i]['description'];
            // 20180830 应田老师需求，去掉名字后面的关键结果统计
        }
        // dd($arr_objective);

        // foreach ($arr_objective as $o) {
            
        // }

        // 转换成json前台js用
        $json_objective = json_encode($arr_objective,JSON_UNESCAPED_UNICODE);
        // 替换key为要求名字
        $json_objective = str_replace("keyresults", "children", $json_objective);
        // dd($json_objective);

        return $json_objective;
    }

    private function getMission($arr_where,$week_start,$week_end){
        // 取目标
        // $mission = Mission::where($arr_where)->whereBetween('created_at',[strtotime($week_start),strtotime($week_end)])->get();

        $mission = Mission::where($arr_where)->whereDate('created_at', '>=', $week_start)->whereDate('created_at', '<', $week_end)->get();
        
        // var_dump($mission);
        // dd($mission);
        // dd($arr_where);

        $arr_mission=$mission->toArray();
        // dd($arr_mission);

        return $arr_mission;
    }

    private function getPlan($arr_where,$week_start,$week_end){
        // 取目标
        // $plan = Plan::where($arr_where)->get();
        $plan = Plan::where($arr_where)->whereDate('created_at', '>=', $week_start)->whereDate('created_at', '<', $week_end)->get();
        // var_dump($mission);
        // dd($mission);

        $arr_plan=$plan->toArray();
        // dd($arr_plan);

        return $arr_plan;
    }

    private function getStateindex($arr_where){
        // 取目标
        $stateindex = Stateindex::where($arr_where)->get();
        // var_dump($mission);
        // dd($mission);

        $arr_stateindex=$stateindex->toArray();
        // dd($arr_mission);

        return $arr_stateindex;
    }

    // 确定当前的季节
    private function which_season(){
        $month = date("m");
        if($month=="03" || $month=="04" || $month=="05"){$season = "1";}
        if($month=="06" || $month=="07" || $month=="08"){$season = "2";}
        if($month=="09" || $month=="10" || $month=="11"){$season = "3";}
        if($month=="12" || $month=="01" || $month=="02"){$season = "4";}
        return $season;
    }

    public function others(Request $request)
    {
        // dd($request);
        $myId = session('idUser');
        $othersId = $request->othersId;
        // 初始化成员数组
        $arr_others = array();
        $arr_others['id'] = "";
        $arr_others['name'] = "";
        $arr_others['position_name'] = "";
        
        // 如果没有接收到成员id，找部门负责人id
        // 20180719 修改为找直接上级id
        if($othersId==""){
            // $user = User::getLeaderIdByUserId($myId);
            // // var_dump($user);
            // // die();
            // if(count($user)>0){
            //     $u = $user[0];
            //     // $othersId=$u->id;
            //     // dd($u);
            //     // $arr_others=$u->toArray();不行报错
            //     $arr_others['id']=$u->id;
            //     $arr_others['name']=$u->name;
            //     $arr_others['position_id']=$u->position_id;
            //     // var_dump($arr_others);die();
            //     $arr_others['position_name']=User::$arr_position[$arr_others['position_id']];
            //     // var_dump($arr_others);die();

            $arr_my = User::find($myId);
            if($arr_my->pid!=""){
                $arr_others = User::find($arr_my->pid)->toArray();
                $arr_others['position_name']=User::$arr_position[$arr_others['position_id']];
            }else{
                $othersId = $myId;
                $arr_others = User::find($othersId)->toArray();
                // var_dump($arr_others);die();
                $arr_others['position_name']=User::$arr_position[$arr_others['position_id']];
            }        
        }else{
            $arr_others = User::find($othersId)->toArray();
            // var_dump($arr_others);die();
            $arr_others['position_name']=User::$arr_position[$arr_others['position_id']];
        }

        // var_dump($arr_others);die();

        // 员工搜索
        $keyword = $request->keyword;
        $tmpUser = new User;
        $arr_allUserDept = $tmpUser->getAllUserDept1($keyword);
        // dd($arr_allUserDept);
        // for ($i=0; $i < count($arr_allUserDept); $i++) { 
        //     for ($j=0; $j < count($arr_allUserDept[$i]['users']); $j++) {
        //         $arr_allUserDept[$i]['users'][$j]['click'] = "youClick('".$arr_allUserDept[$i]['users'][$j]['id']."')";
        //     }
        // }
        // echo empty($arr_allUserDept[0]['userid']);
        // dd($arr_allUserDept);
        for ($i=0; $i < count($arr_allUserDept); $i++) { 
            if (!empty($arr_allUserDept[$i]['userid'])) {
                // echo $arr_allUserDept[$i]['userid'];
                $arr_allUserDept[$i]['click'] = "youClick('".$arr_allUserDept[$i]['userid']."')";
            }
        }
        // dd($arr_allUserDept);
        $json_allUserDept = json_encode($arr_allUserDept,JSON_UNESCAPED_UNICODE);
        // 替换key为要求名字
        $json_allUserDept = str_replace("users", "children", $json_allUserDept);
        // dd($json_allUserDept);
        
        // 我的okr搜索条件
        // 时间维度
        $my_perioditem = $request->my_perioditem;
        // 具体数据
        $my_period = $request->my_period;
        // 没有就默认月度    
        if($my_perioditem==""){$my_perioditem = "1";}
        // 没有就默认当前月
        if($my_period==""){$my_period = $this->which_season();}
        // 如果是月度或季度，加上年 如01月，变成201801，如一季度 变成20181
        if($my_perioditem=="1"){
            $duration1 = date("Y").$my_period;
        }else{
            $duration1 = $my_period;
        }

        $my_weekdate = $request->my_weekdate;
        if($my_weekdate=="")$my_weekdate=date("Y-m-d");
        $arr_my_weekSatrtAndEnd = $this->getWeekStartAndEnd($my_weekdate);
        // dd($arr_weekSatrtAndEnd);
        // var_dump($arr_weekSatrtAndEnd);
        // 拼条件
        $my_arr_where['duration'] = $duration1;
        $my_arr_where['organiser_id'] = $myId;
        $my_arr_where['status'] = 0;
        // var_dump($my_arr_where);
        // dd($my_arr_where);

        // 按条件查询四象限数据
        $my_all['json_objective'] = $this->getObject($my_arr_where);
        $my_all['arr_stateindex'] = $this->getStateindex($my_arr_where);

        $my_arr_where = array();
        $my_arr_where['status'] = 0;
        $my_arr_where['organiser_id'] = $myId;
        // var_dump($my_arr_where);
        // dd($my_arr_where);

        $my_all['arr_mission'] = $this->getMission($my_arr_where,$arr_my_weekSatrtAndEnd[0],$arr_my_weekSatrtAndEnd[1]);
        // var_dump($my_all['arr_mission']);
        $my_all['arr_plan'] = $this->getPlan($my_arr_where,$arr_my_weekSatrtAndEnd[0],$arr_my_weekSatrtAndEnd[1]);

        // var_dump($my_all);
        // others条件     
        $others_perioditem = $request->others_perioditem;
        $others_period = $request->others_period;
        if($others_perioditem==""){$others_perioditem = "1";}
        if($others_period==""){$others_period = $this->which_season();}

        if($others_perioditem=="1"){
            $duration1 = date("Y").$others_period;
        }else{
            $duration1 = $others_period;
        }
        $others_weekdate = $request->others_weekdate;
        if($others_weekdate=="")$others_weekdate=date("Y-m-d");
        $arr_others_weekSatrtAndEnd = $this->getWeekStartAndEnd($others_weekdate);
        // var_dump($arr_weekSatrtAndEnd);

        $others_arr_where['duration'] = $duration1;
        $others_arr_where['organiser_id'] = $arr_others['id'];
        $others_arr_where['status'] = 0;
        // var_dump($others_arr_where);
        // dd("aaaa");

        if($arr_others['id']==""){

            $others_all['json_objective'] = '';
            $others_all['arr_mission'] = array();
            $others_all['arr_plan'] = array();
            $others_all['arr_stateindex'] = array();
        }else{


            $others_all['json_objective'] = $this->getObject($others_arr_where);
            $others_all['arr_stateindex'] = $this->getStateindex($others_arr_where);

            // $others_all['arr_mission'] = $this->getMission($others_arr_where);
            // $others_all['arr_plan'] = $this->getPlan($others_arr_where);

            $others_arr_where = array();
            $others_arr_where['status'] = 0;
            $others_arr_where['organiser_id'] = $arr_others['id'];
            // dd($others_arr_where);\
            // var_dump($others_arr_where);

            $others_all['arr_mission'] = $this->getMission($others_arr_where,$arr_others_weekSatrtAndEnd[0],$arr_others_weekSatrtAndEnd[1]);
            // var_dump($others_all['arr_mission']);
            // dd("aa");
            $others_all['arr_plan'] = $this->getPlan($others_arr_where,$arr_others_weekSatrtAndEnd[0],$arr_others_weekSatrtAndEnd[1]);
            }
        
        // var_dump($others_all);
        // die("aaaaaaaa");



        // $user = User::getLeaderIdByUserId($myId);

        return view('index.others',compact('json_allUserDept', 'my_perioditem', 'my_period',  'my_weekdate', 'others_perioditem', 'othersId', 'others_period', 'others_weekdate', 'keyword', 'arr_others', 'my_all', 'others_all','arr_my_weekSatrtAndEnd','arr_others_weekSatrtAndEnd'));
    }

    public function heisexecutor(Request $request,$p1)
    {

        // 中间部分的部门员工列表
        // 带部门的员工列表
        $keyword = $request->keyword;
        $tmpUser = new User;
        $arr_allUserDept = $tmpUser->getAllUserDept($keyword);
        // dd($arr_allUserDept);
        for ($i=0; $i < count($arr_allUserDept); $i++) { 
            for ($j=0; $j < count($arr_allUserDept[$i]['users']); $j++) {
                $arr_allUserDept[$i]['users'][$j]['click'] = "youClick('".$arr_allUserDept[$i]['users'][$j]['id']."')";
            }
        }
        // dd($arr_allUserDept);
        $json_allUserDept = json_encode($arr_allUserDept,JSON_UNESCAPED_UNICODE);
        // 替换key为要求名字
        $json_allUserDept = str_replace("users", "children", $json_allUserDept);
        // dd($json_allUserDept);

        // 员工id 有了这个才有右侧列表
        $user_id = $request->user_id;

        $arr_period = array();
        $perioditem = $request->perioditem;
        if($perioditem=="")$perioditem="week";
        $period = $request->period;
        if($period=="")$period=1;
        
        if($perioditem!="others"){
            $arr_period = $this->getDate($period);
            $arr_period[0] = substr($arr_period[0], 0,10);
            $arr_period[1] = substr($arr_period[1], 0,10);
        }else{
            $arr_period = explode(" - ",$period);
        }
        // dd($arr_period);

        if($p1==1){$templateName = "index.heisexecutor";}
        if($p1==2){$templateName = "index.heispartake";}

        // 目标列表
        $perPage = 10;

        if($user_id!=""){

            // 取负责人名字
            $executor_id = $user_id;
            // $executor = User::findUser($executor_id)->toArray()['name'];
            $executor = User::findUser($executor_id)->toArray();
            // dd($executor);

            // 我负责的
            if($p1==1){

                $arr_where['executor_id'] = $executor_id;
                $arr_where['status'] = 0;
                
                // 取目标
                $objective = Objective::where($arr_where)
                    ->where(function ($query) use ($arr_period) {
                        $query->where(function ($query) use ($arr_period) {
                                    $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                                })
                                ->orWhere(function ($query) use ($arr_period) {
                                    $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                                    })
                                ->orWhere(function ($query) use ($arr_period) {
                                    $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                                });
                        })
                    ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
            }

            // 我参与的
            if($p1==2){

                // 我参与的目标id集合
                $arr_where_partake = [['user_id', '=', $executor_id],['okr_id', '<', '10000000'],];
                $arr_partake = Partake::where($arr_where_partake)->get(['okr_id'])->toArray();
                // dd($arr_partake);
                $arr_where['status'] = 0;

                // 取目标
                 $objective = Objective::where($arr_where)
                    ->whereIn("id",$arr_partake)
                    ->where(function ($query) use ($arr_period) {
                        $query->where(function ($query) use ($arr_period) {
                                    $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                                })
                                ->orWhere(function ($query) use ($arr_period) {
                                    $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                                    })
                                ->orWhere(function ($query) use ($arr_period) {
                                    $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                                });
                        })
                    ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
            }

            // 取下面的关键结果
            $objective->load("keyresults");
            // dd($objective->toArray());
            // $objective = Objective::where($arr_where)->keyresults()->get();
            // dd($objective->toArray());

            // var_dump($objective->toArray()['data']);
            // 拼所有的关键结果id
            $arr_krids = array();
            $arr_objective = $objective->toArray()['data'];
            for ($i=0; $i < count($arr_objective); $i++) { 
                for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) { 
                    $arr_krids[] = $arr_objective[$i]['keyresults'][$j]['id'];
                }
            }
            // var_dump($arr_krids);
            // 取这些关键结果下的计划，有效的status=0
            $arr_where_plan[] = ['status',0];
            $arr_plan = Plan::where($arr_where_plan)->whereIn("pid",$arr_krids)->orderBy('id',"desc")->get(['id', 'name', 'startdate', 'enddate', 'score', 'scoretime', 'pid'])->toArray();
            // dd($arr_plan);die();

            // 拼一起
            $today = date("Y-m-d");
            for ($i=0; $i < count($arr_objective); $i++) {
                // $arr_objective[$i]['cj']=1;
                $arr_objective[$i]['flag']="objective";
                // $arr_objective[$i]['open']=false;
                $arr_objective[$i]['canDel']=0;
                $arr_objective[$i]['canScore']=0;
                $arr_objective[$i]['kr_count']="0/0";

                // 状态标记
                $arr_objective[$i]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['startdate'],$arr_objective[$i]['enddate'],$arr_objective[$i]['score'],$arr_objective[$i]['scoretime']);

                // // 未开始的能删
                // if($arr_objective[$i]['dateStatus']==1){$arr_objective[$i]['canDel']=1;}
                // // 没下级的能删
                // if(count($arr_objective[$i]['keyresults'])==0){$arr_objective[$i]['canDel']=1;}
                $kr_count = 0;
                $kr_done_count = 0;
                for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) {
                    $kr_count++;
                    // $arr_objective[$i]['keyresults'][$j]['cj']=2;
                    $arr_objective[$i]['keyresults'][$j]['flag']="keyresult";
                    // $arr_objective[$i]['keyresults'][$j]['open']=false;
                    $arr_objective[$i]['keyresults'][$j]['plan_count']="0/0";
                    

                    // 状态标记
                    $arr_objective[$i]['keyresults'][$j]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['keyresults'][$j]['startdate'],$arr_objective[$i]['keyresults'][$j]['enddate'],$arr_objective[$i]['keyresults'][$j]['score'],$arr_objective[$i]['keyresults'][$j]['scoretime']);

                    if($arr_objective[$i]['keyresults'][$j]['dateStatus']==3 or $arr_objective[$i]['keyresults'][$j]['dateStatus']==4){
                        $kr_done_count++;
                    }
                    $arr_objective[$i]['kr_count']=$kr_done_count."/".$kr_count;
                   
                    // $arr_objective[$i]['keyresults'][$j]['dateStatus'] = 4;
                    $plan_count = 0;
                    $plan_done_count = 0;
                    for ($k=0; $k < count($arr_plan); $k++) {
                        if($arr_plan[$k]['pid']==$arr_objective[$i]['keyresults'][$j]['id']){
                            // echo "add before:".$plan_count;
                            $plan_count++;
                            // echo "add after:".$plan_count;
                            // echo "<br>";
                            // $arr_plan[$k]['cj']=3;
                            $arr_plan[$k]['flag']="plan";

                            // 状态标记
                            $arr_plan[$k]['dateStatus'] = Objective::getDateStatus($arr_plan[$k]['startdate'],$arr_plan[$k]['enddate'],$arr_plan[$k]['score'],$arr_plan[$k]['scoretime']);
                            // echo $arr_plan[$k]['dateStatus'];
                            if($arr_plan[$k]['dateStatus']==3 or $arr_plan[$k]['dateStatus']==4){
                                $plan_done_count++;
                            }
                            $arr_objective[$i]['keyresults'][$j]['plan_count']=$plan_done_count."/".$plan_count;
                            
                            $arr_objective[$i]['keyresults'][$j]['plans'][]=$arr_plan[$k];
                        }
                    }

                    $arr_objective[$i]['keyresults'][$j]['name'] = $arr_objective[$i]['keyresults'][$j]['name'] . "(".$arr_objective[$i]['keyresults'][$j]['plan_count'].")";
                }

                // （进行中的或已逾期未评分的）且（下级完成数==总数的）可以评分
                if(($arr_objective[$i]['dateStatus']==2 || ($arr_objective[$i]['dateStatus']==4 && $arr_objective[$i]['score']==999)) && ($kr_count==$kr_done_count)){
                    $arr_objective[$i]['canScore']=1;
                }

                // 改写标题，加入下级完成状态计数
                $arr_objective[$i]['name'] = $arr_objective[$i]['name'] . "(".$arr_objective[$i]['kr_count'].")";
            }
            // dd($arr_objective);

            // foreach ($arr_objective as $o) {
                
            // }

            // 转换成json前台js用
            $json_objective = json_encode($arr_objective,JSON_UNESCAPED_UNICODE);
            // 替换key为要求名字
            $json_objective = str_replace("keyresults", "children", $json_objective);
            $json_objective = str_replace("plans", "children", $json_objective);
            // dd($json_objective);

            // dd($p1);

            // die();

            // 带部门的员工列表
            $tmpUser = new User;
            $arr_allUserDept = $tmpUser->getAllUserDept();

            return view($templateName,compact('arr_allUserDept','json_objective','objective','executor', 'executor_id', 'perioditem', 'period', 'arr_period','p1','json_allUserDept','keyword','user_id'));

        }else{

            $executor_id = "";
            $executor = array(
                "id" => "",
                "name" => "",
                "phone" => "",
                "email" => "",
                "pwd" => "",
                "position_id" => "",
                "department_id" => "",
                "status" => "",
                "pid" => "",
                "isleader" => "",
                "created_at" => "",
                "updated_at" => "",
                "position_name" => "",
            );

            $arr_where['id'] = 0;
            $objective = Objective::where($arr_where)->paginate($perPage);
            $json_objective = "''";

            return view($templateName,compact('arr_allUserDept','objective','json_objective','executor', 'executor_id', 'perioditem', 'period', 'arr_period','p1','json_allUserDept','keyword','user_id'));

        }
    }

    // 新增
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:department|max:50',
        //     'pid' => 'required|integer',
        //     'status' => 'required',Rule::in(["0","1"]),
        // ]);

        

        $rules = [
            'durationflag' => 'required|',
            'duration' => 'required|',
            'o_description' => 'required|',
            
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

        $data['durationflag'] = $request->durationflag;
        $duration = $request->duration;
        if($data['durationflag']==0 || $data['durationflag']==1){$duration = date("Y").$duration;}
        // if($data['durationflag']==3){$duration = date("Y").$duration;}
        
        $data['duration'] = $duration;   
        $data['organiser_id'] = session('idUser');        
        $data['description'] = $request->o_description;

        // var_dump($data);
        // // var_dump($arr_partake_id);
        // die();
        // dd("bbbbbb");
        $objective = Objective::create($data);
        // var_dump($objective->id);die();
        // return;

        // $objectiveLog = $this->setLog(1,1,'descbefore','descafter');

        // $dd1['type'] = 1;
        // $dd1['oid'] = 1;
        // $dd1['descbefore'] = 'a';
        // $dd1['descafter'] = 'b';
        // $dd1['id'] = 1;
        // $dd1['created_at'] = '2018-12-29 00:00:00';
        // $dd1['updated_at'] = '2018-12-29 00:00:00';
        
        // // dd($dd1);
        // // $a = new Objectivelog;
        // // $a->create($dd1);

        // $sql = "INSERT INTO `objectivelogs` (`id`, `oid`, `type`, `descbefore`, `descafter`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '11', '11', '2018-12-31 00:00:00', NULL)";
        // DB::insert($sql);



        if($objective===false){
            $array = array('msg'=>'新增目标失败!','status'=>0);
            return json_encode($array);
        }else{


            $itemid = $objective->id;
            $type = 0;
            $descbefore = "";
            $descafter = $data['description'];

            $this->setLog($type,$itemid,$descbefore,$descafter);


            $array = array('msg'=>'新增目标成功!','status'=>1);
            return json_encode($array);            
        }
    }

    // 加log
    private function setLog($type,$itemid,$descbefore,$descafter){
        $data['type'] = $type;
        $data['itemid'] = $itemid;
        $data['descbefore'] = $descbefore;
        $data['descafter'] = $descafter;
        $data['created_at'] = date("Y-m-d H:i:s");

        // $data = [
        // 'type' => $type,
        // 'oid' => $oid,
        // 'descbefore' => $descbefore,
        // 'descafter' => $descafter,
        // ];
        
        DB::table('objectivelogs')->insert($data);
        // Objectivelog::create($data);

        // $now = date("Y-m-d H:i:s");
        // $sql = "INSERT INTO `objectivelogs` (`id`, `oid`, `type`, `descbefore`, `descafter`, `created_at`, `updated_at`) VALUES (NULL, '".$oid."', '".$type."', '".$descbefore."', '".$descafter."', '".$now."', NULL)";
        // DB::insert($sql);
    }

    // 评分
    public function score(Request $request)
    {
        
        // dd($request);
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
        
        $item = Objective::find($request->id);
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
        
        $item = Objective::find($request->id)->toArray();

        // dd($item);
        return json_encode($item);
    }

    // 更新
    public function update(Request $request)
    {
        
        // dd($request);
        $rules = [
            'o_id' => 'required|integer',
            'o_description' => 'required|',
            
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
        $data['id'] = $request->o_id;
        $data['description'] = $request->o_description;
        
        // dd($data);
        $item = Objective::find($data['id']);
        $descbefore = $item->description;
        // dd($item['description']);
        $item->description=$data['description'];

        // $arr_partake_id = $request->o_partake_id;

        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{

            $itemid = $data['id'];
            $type = 2;
            $descafter = $data['description'];

            $this->setLog($type,$itemid,$descbefore,$descafter);

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

        $item = Objective::find($data['id']);
        
        // $item['canDel'] = Objective::ifCandel($item);
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

            $itemid = $data['id'];
            $type = 1;
            $descbefore = $item->description;
            $descafter = "";

            $this->setLog($type,$itemid,$descbefore,$descafter);


            $array = array('msg'=>'删除成功!','status'=>1);
            return json_encode($array);
        }
    }

    public function getDate($index){
        // echo $index;
        // echo "<br>";
        // // date("m")
        // // date("d")
        // echo date("w")+1;
        // echo "<br>";
        // echo date("d");
        // echo "<br>";
        // echo date("d")-date("w")+1;
        
        // $w = date("w")==0 ? 7 : date("w");
        // echo "<br>";
        // echo $w;

        // 1本周 2上周 3下周
        switch ($index) {
            case 1:

                // $w = date("w")=0:7?date("w");
                $w = date("w")==0 ? 7 : date("w");
                $start = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-$w+1,date("Y"))); 
                $end = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-$w+7,date("Y")));
                break;

            case 2:
                $w = date("w")==0 ? 7 : date("w");
                $start = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-$w+1-7,date("Y")));
                $end = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-$w+7-7,date("Y")));
                break;

            case 3:
                $w = date("w")==0 ? 7 : date("w");
                $start = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-$w+1+7,date("Y")));
                $end = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-$w+7+7,date("Y")));
                break;


            case 101:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,1,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,2,1,date("Y"))-1); 
                break;
            case 102:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,2,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,3,1,date("Y"))-1); 
                break;
            case 103:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,3,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,4,1,date("Y"))-1); 
                break;
            case 104:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,4,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,5,1,date("Y"))-1); 
                break;
            case 105:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,5,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,6,1,date("Y"))-1); 
                break;
            case 106:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,6,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,7,1,date("Y"))-1); 
                break;
            case 107:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,7,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,8,1,date("Y"))-1); 
                break;
            case 108:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,8,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,9,1,date("Y"))-1); 
                break;
            case 109:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,9,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,10,1,date("Y"))-1); 
                break;
            case 110:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,10,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,11,1,date("Y"))-1); 
                break;
            case 111:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,11,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,12,1,date("Y"))-1); 
                break;
            case 112:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,12,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,12,31,date("Y"))); 
                break;


            case 1001:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,1,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,4,1,date("Y"))-1); 
                break;
            case 1002:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,4,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,7,1,date("Y"))-1); 
                break;
            case 1003:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,7,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,10,1,date("Y"))-1); 
                break;
            case 1004:
                $start  = date("Y-m-d H:i:s",mktime(0,0,0,10,1,date("Y"))); 
                $end    = date("Y-m-d H:i:s",mktime(0,0,0,12,31,date("Y"))); 
                break;

            default:
                # code...
                break;
        }

        // var_dump(array($start,$end));die();
        return array($start,$end);
    }

    // 操作历史
    public function mineObjectivelog(Request $request)
    {
        $durationflag = $request->durationflag;
        $duration = $request->duration;
        $userid = $request->userid;
        if($userid=="")$userid=session('idUser');
        if($durationflag=='' || $duration==''){die('参数错误');}

        $arr_where['durationflag'] = $durationflag;
        if($arr_where['durationflag']==1){
            $duration1 = date("Y").$duration;
        }else{
            $duration1 = $duration;
        }
        $arr_where['duration'] = $duration1;
        $arr_where['organiser_id'] = $userid;

        // var_dump($arr_where);die();
        $arr_objective = Objective::where($arr_where)->get()->toArray();
        $ids = array_column($arr_objective, 'id');
        $str_ids = implode($ids, ",");
        // var_dump($str_ids);die();

        $arr_log = Objectivelog::whereIn("itemid",$ids)->get()->toArray();
        // var_dump($arr_objective);die();

        return view('index.mineObjectivelog',compact('arr_log'));
    }

}
