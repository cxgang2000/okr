<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    //
    protected $table = 'objective';

    protected $fillable=['name','startdate','enddate','organiser_id','executor_id','description','score','status']; 


    public function keyresults()
    {
        // return $this->hasMany('App\Models\Keyresult','pid');
        $arr_where['status'] = 0; 
        return $this->hasMany('App\Models\Keyresult','pid')->where($arr_where)->select('id', 'name', 'startdate', 'enddate', 'score', 'scoretime', 'pid')->orderBy('id','desc');
    }


    // 取执行人
    public function executor(){
        return $this->hasOne('App\Models\User',"id","executor_id")->withDefault()->select(['id','name']);
    }

    // 取参与者
    public function partake(){
        return $this->hasMany('App\Models\Partake',"okr_id","id")->select(['user_id','okr_id']);
    }
    

    // 计算当前项目的状态
    public static function getDateStatus($startdate,$enddate,$socre,$socretime)
    {

        // echo $startdate." ".$enddate." ".$socre." ".$socretime."<br>";

        $dateStatus = 0;
        $today = date("Y-m-d");

        // 1未开始：开始时间大于今天的
        // 3已完成：结束时间小于今天(去掉) 且 评分！=999 且 评分时间 < 结束时间
        // 4已逾期：结束时间小于今天 且 （评分=999 或 评分时间 > 结束时间）
        // 2进行中：开始时间 <= 今天 <= 结束时间 且 评分=999

        // 未开始
        // echo $startdate.' '.$today."<br>";
        if($startdate>$today){
            $dateStatus=1;
        }
        // 进行中
        if($startdate<=$today && $enddate>=$today && $socre==999){
            $dateStatus=2;
        }
        // 已完成
        // if($arr_objective[$i]['enddate']<$today && $arr_objective[$i]['score']!="999.0" && date("Y-m-d",strtotime($arr_objective[$i]['scoretime']))<=$arr_objective[$i]['enddate']){
        if($socre!="999.0" && date("Y-m-d",strtotime($socretime))<=$enddate){            
            $dateStatus=3;
        }
        // 已逾期
        if($enddate<$today && ($socre=="999.0" || date("Y-m-d",strtotime($socretime))>$enddate)){
            $dateStatus=4;
        }
        return $dateStatus;
    }
}
