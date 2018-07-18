<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyresult extends Model
{
    //
    protected $table = 'keyresult';

    protected $fillable=['description','score','status','confidentindex','pid']; 


    public function plan()
    {
        // return $this->hasMany('App\Models\Keyresult','pid');
        $arr_where['status'] = 0; 
        return $this->hasMany('App\Models\Plan','pid')->where($arr_where)->select('id', 'name', 'startdate', 'enddate', 'score', 'scoretime', 'pid')->orderBy('id','desc');
    }

    // 取执行人
    // public function executor(){
    //     return $this->hasOne('App\Models\User',"id","executor_id")->withDefault()->select(['id','name']);
    // }

    // 取参与者
    public function partake(){
        return $this->hasMany('App\Models\Partake',"okr_id","id")->select(['user_id','okr_id']);
    }


    // 取父目标
    public function objective(){
        return $this->belongsTo('App\Models\Objective',"pid","id");
    }


    // 是否可以删除
    public static function ifCandel($arr_keyresult)
    {
        $candel = 1;
        $msg = "";

        // var_dump($arr_objective);
        // 发布者登录
        if($arr_keyresult['executor_id']!=session("idUser")){
            $candel = 0;
            $msg = "不是执行人不能删除";
            return array($candel,$msg);
        }
        // 未开始的能删
        if($arr_keyresult['dateStatus']==2 || $arr_keyresult['dateStatus']==3 || $arr_keyresult['dateStatus']==4){
            $candel = 0;
            $msg = "该状态的不能删除";
            return array($candel,$msg);
        }
        // 没下级的能删
        // echo "aaaaaaaa:".count($arr_objective['keyresults']);
        if(count($arr_keyresult['plan'])!=0){
            $candel = 0;
            $msg = "有下级的不能删除";
            return array($candel,$msg);
        }   
        
        return array($candel,$msg); 
    }

    // 取评论
    public function comments(){
        return $this->hasMany('App\Models\Comment',"okr_id","id")->orderBy('id', 'desc')->select();
    }


    // 取信心指数
    public function confidentindex(){
        return $this->hasMany('App\Models\Confidentindex',"okr_id","id")->orderBy('id', 'desc')->select();
    }


}
