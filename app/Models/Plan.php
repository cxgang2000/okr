<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plan';

    protected $fillable=['name','startdate','enddate','executor_id','description','score','status','pid']; 


    // public function keyresults()
    // {
    //     return $this->hasMany('App\Keyresult');
    // }

    // 取参与者
    public function partake(){
        return $this->hasMany('App\Models\Partake',"okr_id","id")->select(['user_id','okr_id']);
    }

    // 取父关键结果
    public function keyresult(){
        return $this->belongsTo('App\Models\Keyresult',"pid","id");
    }


    // 是否可以删除
    public static function ifCandel($arr_plan)
    {
        $candel = 1;
        $msg = "";

        // var_dump($arr_objective);
        // 发布者登录
        if($arr_plan['executor_id']!=session("idUser")){
            $candel = 0;
            $msg = "不是执行人不能删除";
            return array($candel,$msg);
        }
        // 未开始的能删
        if($arr_plan['dateStatus']==2 || $arr_plan['dateStatus']==3 || $arr_plan['dateStatus']==4){
            $candel = 0;
            $msg = "该状态的不能删除";
            return array($candel,$msg);
        }
        
        return array($candel,$msg); 
    }

    // 取评论
    public function comments(){
        return $this->hasMany('App\Models\Comment',"okr_id","id")->orderBy('id', 'desc')->select();
    }
}
