<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
   
    protected $fillable = [
        'name', 'state_id', 'state_code', 'country_id', 'country_code', 'latitude', 'longitude', 'flag', 'wikiDataId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
}
