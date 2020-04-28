<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    protected $table = 'plan';

    protected $fillable=['durationflag','duration','organiser_id','description','status','mission_at']; 


    // 取评论
    public function comments(){
        return $this->hasMany('App\Models\Comment',"okr_id","id")->orderBy('id', 'desc')->select();
    }
}
