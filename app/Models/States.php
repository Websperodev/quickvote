<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class States extends Model
{
   
    protected $fillable = [
        'name', 'country_id', 'country_code', 'fips_code', 'iso2', 'flag', 'wikiDataId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    
}
