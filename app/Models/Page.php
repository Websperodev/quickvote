<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
   
    protected $fillable = [
        'page_name', 'section', 'heading1', 'heading2', 'heading3', 'description', 'img1', 'img2', 'img3'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

   
}
