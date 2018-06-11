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

}
