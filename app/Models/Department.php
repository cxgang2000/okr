<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable=['name','pid','status']; 

    public function pname()
    {
        return $this->hasOne('App\Models\Department',"id","pid");
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    // :( 搞不定，自己写吧
    // public function getchildren()
    // {
    //     return $this->belongsToMany('App\Models\Department',"department","id","pid");
    // }

    public static function hasChildren($id)
    {
        $arr_where['pid'] = $id;
        $arr_status = [0,1];
        
        $a = Department::whereIn("status",$arr_status)->where($arr_where)->get(['id','name']);
        // dd(count($a));
        if(count($a)>0){
            return 1;
        }else{
            return 0;
        }
    }
}
