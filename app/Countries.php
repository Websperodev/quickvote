<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
   
    
    protected $fillable = [
        'name', 'iso3', 'iso2', 'capital', 'phonecode', 'currency', 'native', 'region', 'subregion', 'timezones', 'emoji', 'emojiU', 'flag', 'wikiDataId'
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
