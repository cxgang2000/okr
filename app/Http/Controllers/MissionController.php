<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Mission;
use App\Models\Missionlog;

use Illuminate\Support\Facades\DB;

use Validator;

class MissionController extends Controller
{

    // public function __construct()
    // {
 
    //     // 验证是否登录
    //     $this->middleware(function ($request, $next) {
    //         if (!$request->session()->has('idUser')) {
    //             redirect('index/login')->send();exit();
    //         }             
    //         return $next($request);
    //     });
    // }


    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'durationflag' => 'required|',
            'duration' => 'required|',
            'm_description' => 'required|',
            'm_importance' => 'required|',
        ];

        $validator = Validator::make($request->all(), $rules);
        // var_dump($validator);die();
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
        // if($data['durationflag']==3){$duration = date("Y").$duration;}
        if($data['durationflag']==1){$duration = date("Y").$duration;}        
        $data['duration'] = $duration;   
        $data['organiser_id'] = session('idUser'); 
        $data['description'] = $request->m_description;
        $data['importance'] = $request->m_importance;

        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $mission = Mission::create($data);
        // var_dump($objective->id);die();
        // return;
        if($mission===false){
            $array = array('msg'=>'新增本周关注的任务失败!','status'=>0);
            return json_encode($array);
        }else{

            $itemid = $mission->id;
            $type = 0;
            $descbefore = "";
            $descafter = $data['description'];

            $this->setLog($type,$itemid,$descbefore,$descafter);

            $array = array('msg'=>'新增本周关注的任务结果成功!','status'=>1);
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
        
        DB::table('missionlogs')->insert($data);
        // Objectivelog::create($data);

        // $now = date("Y-m-d H:i:s");
        // $sql = "INSERT INTO `objectivelogs` (`id`, `oid`, `type`, `descbefore`, `descafter`, `created_at`, `updated_at`) VALUES (NULL, '".$oid."', '".$type."', '".$descbefore."', '".$descafter."', '".$now."', NULL)";
        // DB::insert($sql);
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
        
        $item = Mission::find($request->id);
        $item->load("comments.userName");

        $item = $item->toArray();
        // dd($item);
        return $item;
    }

    // 更新
    public function update(Request $request)
    {

        $rules = [
            'id' => 'required|integer',
            'm_description' => 'required|',
            'm_importance' => 'required|',
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
        $data['description'] = $request->m_description;
        $data['importance'] = $request->m_importance;
        
        $item = Mission::find($data['id']);
        $descbefore = $item->description;
        // dd($item);
        $item->description=$data['description'];
        $item->importance=$data['importance'];
        
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

        $item = Mission::find($data['id']);
        
        // $item['canDel'] = Keyresult::ifCandel($item);
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

    // 操作历史
    public function missionlog(Request $request)
    {
        $weekdate = $request->weekdate;
        $userid = $request->userid;
        if($userid=="")$userid=session('idUser');
        if($weekdate==''){die('参数错误');}

        $arr_weekSatrtAndEnd = $this->getWeekStartAndEnd($weekdate);

        $arr_where['organiser_id'] = $userid;

        // var_dump($arr_where);die();
        $arr_mission = Mission::where($arr_where)->whereDate('created_at', '>=', $arr_weekSatrtAndEnd[0])->whereDate('created_at', '<=', $arr_weekSatrtAndEnd[1])->get()->toArray();
        $ids = array_column($arr_mission, 'id');
        $str_ids = implode($ids, ",");
        // var_dump($str_ids);die();

        $arr_log = Missionlog::whereIn("itemid",$ids)->get()->toArray();
        // var_dump($arr_objective);die();

        return view('index.mineObjectivelog',compact('arr_log'));
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
}
