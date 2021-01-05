<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
   
    protected $fillable = [
        'question', 'answer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    
}
