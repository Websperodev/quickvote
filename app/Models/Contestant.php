<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
   
    protected $fillable = [
        'event_id', 'name', 'phone', 'image', 'state_id', 'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

   
}
 