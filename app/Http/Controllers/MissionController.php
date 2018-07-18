<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Mission;

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
        $rules = [
            'durationflag' => 'required|',
            'duration' => 'required|',
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

        $data['durationflag'] = $request->durationflag;
        $duration = $request->duration;
        if($data['durationflag']==0 || $data['durationflag']==1){$duration = date("Y").$duration;}
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
            $array = array('msg'=>'新增本周关注的任务结果成功!','status'=>1);
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
        // dd($item);
        $item->description=$data['description'];
        $item->importance=$data['importance'];
        
        $item->save();
        // dd($item);

        if($item===false){
            $array = array('msg'=>'编辑失败!','status'=>0);
            return json_encode($array);
        }else{
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
            $array = array('msg'=>'删除成功!','status'=>1);
            return json_encode($array);
        }
    }
}
