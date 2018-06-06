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
        return $this->hasOne('App\Models\User');
    }
}
