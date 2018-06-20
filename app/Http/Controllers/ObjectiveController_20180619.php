<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Department;
use App\Models\Objective;
use App\Models\Partake;

use App\Models\Plan;

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
        $executor = User::find($executor_id)->toArray()['name'];
        // dd($executor);

        // 目标列表
        $perPage = 3;
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

            // ->where(function ($query) use ($arr_period) {
            //     $query->whereBetween('startdate', $arr_period)
            //             ->orWhereBetween('enddate', $arr_period)
            //             ->orWhere(function ($query) use ($arr_period) {
            //                 $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
            //             });
            //     })

            // ->where(function ($query) use ($arr_period) {
            //         $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
            //     })
            // ->orWhere(function ($query) use ($arr_period) {
            //         $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
            //     })
            // ->orWhere(function ($query) use ($arr_period) {
            //         $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
            //     })

            // ->whereRaw(('startdate>=? and startdate<=?') or (('enddate>=? and enddate<=?')), $arr_period)

            // ->whereRaw("(`startdate` <= '2018-06-17' and `startdate` >= '2018-06-11') or (`enddate` <= '2018-06-17' and `enddate` >= '2018-06-11') or (`startdate` <= '2018-06-11' and `enddate` >= '2018-06-17')")

            ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
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
            $arr_objective[$i]['candel']=0;

            // 状态标记
            $arr_objective[$i]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['startdate'],$arr_objective[$i]['enddate'],$arr_objective[$i]['score'],$arr_objective[$i]['scoretime']);

            // // 未开始的能删
            // if($arr_objective[$i]['dateStatus']==1){$arr_objective[$i]['candel']=1;}
            // // 没下级的能删
            // if(count($arr_objective[$i]['keyresults'])==0){$arr_objective[$i]['candel']=1;}

            for ($j=0; $j < count($arr_objective[$i]['keyresults']); $j++) {
                // $arr_objective[$i]['keyresults'][$j]['cj']=2;
                $arr_objective[$i]['keyresults'][$j]['flag']="keyresult";
                // $arr_objective[$i]['keyresults'][$j]['open']=false;

                // 状态标记
                $arr_objective[$i]['keyresults'][$j]['dateStatus'] = Objective::getDateStatus($arr_objective[$i]['keyresults'][$j]['startdate'],$arr_objective[$i]['keyresults'][$j]['enddate'],$arr_objective[$i]['keyresults'][$j]['score'],$arr_objective[$i]['keyresults'][$j]['scoretime']);
               
                // $arr_objective[$i]['keyresults'][$j]['dateStatus'] = 4;

                for ($k=0; $k < count($arr_plan); $k++) { 
                    if($arr_plan[$k]['pid']==$arr_objective[$i]['keyresults'][$j]['id']){
                        // $arr_plan[$k]['cj']=3;
                        $arr_plan[$k]['flag']="plan";

                        // 状态标记
                        $arr_plan[$k]['dateStatus'] = Objective::getDateStatus($arr_plan[$k]['startdate'],$arr_plan[$k]['enddate'],$arr_plan[$k]['score'],$arr_plan[$k]['scoretime']);

                        $arr_objective[$i]['keyresults'][$j]['plans'][]=$arr_plan[$k];
                    }
                }
            }
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

        if($p1==1){$templateName = "index.iamexecutor";}
        if($p1==2){$templateName = "index.iampartake";}

        return view($templateName,compact('arr_allUserDept','json_objective','objective','executor', 'executor_id', 'perioditem', 'period', 'arr_period','p1'));
    }

    public function iampartake(Request $request)
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


        $executor_id = session('idUser');
        
        // 带部门的员工列表
        $tmpUser = new User;
        $arr_allUserDept = $tmpUser->getAllUserDept();

        // 目标列表
        $perPage = 10;
        $executor = User::find($executor_id)->toArray()['name'];
        // dd($executor);


        $arr_where_partake = [['user_id', '=', $executor_id],['okr_id', '<', '10000000'],];
        $arr_partake = Partake::where($arr_where_partake)->get(['okr_id'])->toArray();
        // dd($arr_partake);



        $arr_where['status'] = 0;
        
        // 取目标
        $objective = Objective::where($arr_where)
            ->whereIn("id",$arr_partake)
            ->where(function ($query) use ($arr_period) {
                    $query->where('startdate', '<=', $arr_period[1])->where('startdate', '>=', $arr_period[0]);
                })
            ->orWhere(function ($query) use ($arr_period) {
                    $query->where('enddate', '<=', $arr_period[1])->where('enddate', '>=', $arr_period[0]);
                })
            ->orWhere(function ($query) use ($arr_period) {
                    $query->where('startdate', '<=', $arr_period[0])->where('enddate', '>=', $arr_period[1]);
                })
            ->orderBy('id',"desc")->select('id','name', 'startdate', 'enddate', 'score', 'scoretime')->paginate($perPage);
        


        dd($objective->toArray());







    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:department|max:50',
        //     'pid' => 'required|integer',
        //     'status' => 'required',Rule::in(["0","1"]),
        // ]);

        $rules = [
            'o_name' => 'required|',
            'o_date' => 'required|',
            'o_executor_id' => 'required|integer',
            'o_partake_id' => 'required|',
            
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

        $data['name'] = $request->o_name;
        $data['organiser_id'] = session('idUser');
        $data['executor_id'] = $request->o_executor_id;

        $arr_date = explode(" - ", $request->o_date);
        $data['startdate'] = $arr_date[0];
        $data['enddate'] = $arr_date[1];
        
        $data['description'] = $request->o_description;

        $arr_partake_id = $request->o_partake_id;

        
        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $objective = Objective::create($data);
        // var_dump($objective->id);die();
        // return;

        if($objective===false){
            $array = array('msg'=>'新增目标失败!','status'=>0);
            return json_encode($array);
        }else{

            foreach ($arr_partake_id as $v) {
               $arr_partake[] = ['okr_id'=>$objective->id,'user_id'=>$v,'created_at'=>date("Y-m-d H:i:s")];
            }
            // var_dump($arr_partake);
            
            DB::table('partake')->insert($arr_partake);

            $array = array('msg'=>'新增目标成功!','status'=>1);
            return json_encode($array);
            
        }
    }


    // 评分
    public function score(Request $request)
    {
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
        
        $item = Objective::find($request->id);
        $item->load("keyresults","executor","partake");
        
        // $item->load("partake");
        $item = $item->toArray();
        // dd($item);
        $item['newpartake'] = array_column($item['partake'],"user_id");
        
        // 状态标记
        $item['dateStatus'] = Objective::getDateStatus($item['startdate'],$item['enddate'],$item['score'],$item['scoretime']);

        // 能否删除标记
        // $item['candel'] = Objective::ifCandel($item)[0];
        $item['candel'] = Objective::ifCandel($item);
        
        // dd($item);
        return json_encode($item);
    }


    // 更新
    public function update(Request $request)
    {
        
        $rules = [
            'o_id' => 'required|integer',
            'o_date' => 'required|',
            'o_partake_id' => 'required|',
            
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
        $arr_date = explode(" - ", $request->o_date);
        $data['startdate'] = $arr_date[0];
        $data['enddate'] = $arr_date[1];
        $data['description'] = $request->o_description;
        $arr_partake_id = $request->o_partake_id;


        $item = Objective::find($data['id']);
        // dd($item);
        $item->startdate=$data['startdate'];
        $item->enddate=$data['enddate'];
        $item->description=$data['description'];

        // $arr_partake_id = $request->o_partake_id;

        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{

            // 删参与者 增参与者
            $arr_where['okr_id'] = $request->o_id; 
            $del_num = Partake::where($arr_where)->delete();

            foreach ($arr_partake_id as $v) {
               $arr_partake[] = ['okr_id'=>$data['id'],'user_id'=>$v,'created_at'=>date("Y-m-d H:i:s")];
            }
            // var_dump($arr_partake);
            
            DB::table('partake')->insert($arr_partake);

            // Partake::addAll($arr_partake);


            $array = array('msg'=>'编辑成功!','status'=>1);
            return json_encode($array);
        }
    }

    // 删除
    public function delete(Request $request)
    {
        
        $rules = [
            'o_id' => 'required|integer',
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

        $item = Objective::find($data['id']);
        $item->load("keyresults");
        $item['dateStatus'] = Objective::getDateStatus($item['startdate'],$item['enddate'],$item['score'],$item['scoretime']);

        $item['candel'] = Objective::ifCandel($item);
        // 不能删就返回
        if($item['candel'][0]==0){
            $array = array('msg'=>$item['candel'][1],'status'=>0);
            return json_encode($array);
        }

        // dd($item);

        unset($item['candel']);
        unset($item['dateStatus']);
        unset($item['keyresults']);
        
        

        $item->status=1;
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'删除失败!','status'=>0);
            return json_encode($array);
        }else{

            // 删不删参与者呢？这是个问题，先不删了吧，万一哪天要恢复呢
            // 删参与者 增参与者
            // $arr_where['okr_id'] = $request->o_id; 
            // $del_num = Partake::where($arr_where)->delete();
            
            // DB::table('partake')->insert($arr_partake);

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


}
