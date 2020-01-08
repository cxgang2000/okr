<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Stateindex;
use App\Models\Stateindexlog;

use Illuminate\Support\Facades\DB;

use Validator;

class StateindexController extends Controller
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
        $rules = [
            'durationflag' => 'required|',
            'duration' => 'required|',
            's_description' => 'required|',
            's_state' => 'required|',
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
        // if($data['durationflag']==0 || $data['durationflag']==1){$duration = date("Y").$duration;}
        if($data['durationflag']==3){$duration = date("Y").$duration;}
        $data['duration'] = $duration;   
        $data['organiser_id'] = session('idUser'); 
        $data['description'] = $request->s_description;
        $data['state'] = $request->s_state;

        // var_dump($data);
        // var_dump($arr_partake_id);
        // die();

        $stateindex = Stateindex::create($data);
        // var_dump($objective->id);die();
        // return;
        if($stateindex===false){
            $array = array('msg'=>'新增状态指标失败!','status'=>0);
            return json_encode($array);
        }else{

            $itemid = $stateindex->id;
            $type = 0;
            $descbefore = "";
            $descafter = $data['description'];

            $this->setLog($type,$itemid,$descbefore,$descafter);

            $array = array('msg'=>'新增状态指标成功!','status'=>1);
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
        
        DB::table('stateindexlogs')->insert($data);
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
        
        $item = Stateindex::find($request->id);
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
            's_description' => 'required|',
            's_state' => 'required|',
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
        $data['description'] = $request->s_description;
        $data['state'] = $request->s_state;
        // dd($data);
        $item = Stateindex::find($data['id']);
        $descbefore = $item->description;
        // dd($item);
        $item->description=$data['description'];
        $item->state=$data['state'];
        
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

        $item = Stateindex::find($data['id']);
        
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
    public function stateindexlog(Request $request)
    {
        $durationflag = $request->durationflag;
        $duration = $request->duration;
        if($durationflag=='' || $duration==''){die('参数错误');}

        $arr_where['durationflag'] = $durationflag;
        if($arr_where['durationflag']==3){
            $duration1 = date("Y").$duration;
        }else{
            $duration1 = $duration;
        }
        $arr_where['duration'] = $duration1;
        $arr_where['organiser_id'] = session('idUser');

        // var_dump($arr_where);die();
        $arr_stateindex = Stateindex::where($arr_where)->get()->toArray();
        $ids = array_column($arr_stateindex, 'id');
        $str_ids = implode($ids, ",");
        // var_dump($str_ids);die();

        $arr_log = Stateindexlog::whereIn("itemid",$ids)->get()->toArray();
        // var_dump($arr_objective);die();

        return view('index.mineObjectivelog',compact('arr_log'));
    }
}
