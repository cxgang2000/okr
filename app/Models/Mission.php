<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mission extends Model
{
    protected $table = 'mission';

    protected $fillable=['durationflag','duration','organiser_id','description','importance','status','mission_at']; 


    // 取评论
    public function comments(){
        return $this->hasMany('App\Models\Comment',"okr_id","id")->orderBy('id', 'desc')->select();
    }
}
