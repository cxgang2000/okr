<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confidentindex extends Model
{
    //
    protected $table = 'confidentindex';

    protected $fillable=['okr_id','oldconfidentindex','newconfidentindex','description']; 


    
}
