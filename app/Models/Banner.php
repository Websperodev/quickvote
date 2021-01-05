<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
   
    protected $fillable = [
        'page', 'heading1', 'heading2', 'description', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    
}
