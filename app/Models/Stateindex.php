<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Stateindex extends Model
{
    protected $table = 'stateindex';

    protected $fillable=['durationflag','duration','organiser_id','description','state','status']; 


    // 取评论
    public function comments(){
        return $this->hasMany('App\Models\Comment',"okr_id","id")->orderBy('id', 'desc')->select();
    }
}
