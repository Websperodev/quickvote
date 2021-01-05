<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactQuerie extends Model
{
   
    protected $fillable = [
        'name', 'email', 'subject', 'phone', 'message', 'is_read'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

   
}
 