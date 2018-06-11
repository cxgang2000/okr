<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyresult extends Model
{
    //
    protected $table = 'keyresult';

    protected $fillable=['name','startdate','enddate','description','score','status','pid']; 


    // public function keyresults()
    // {
    //     return $this->hasMany('App\Keyresult');
    // }

    // 取执行人
    // public function executor(){
    //     return $this->hasOne('App\Models\User',"id","executor_id")->withDefault()->select(['id','name']);
    // }

    // 取参与者
    public function partake(){
        return $this->hasMany('App\Models\Partake',"okr_id","id")->select(['user_id','okr_id']);
    }

}
