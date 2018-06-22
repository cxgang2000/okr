<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable=['okr_id','user_id','comment']; 
  

    // 取评论者姓名
    public function userName(){
        return $this->hasOne('App\Models\User',"id","user_id")->withDefault()->select(['id','name']);
    }

}
