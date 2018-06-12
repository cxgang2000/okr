<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plan';

    protected $fillable=['name','startdate','enddate','description','score','status','pid']; 


    // public function keyresults()
    // {
    //     return $this->hasMany('App\Keyresult');
    // }

    // 取参与者
    public function partake(){
        return $this->hasMany('App\Models\Partake',"okr_id","id")->select(['user_id','okr_id']);
    }
}
