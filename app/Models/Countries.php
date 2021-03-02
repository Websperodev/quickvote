<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model {

    protected $fillable = [
        'name', 'iso3', 'iso2', 'capital', 'phonecode', 'currency', 'native', 'region', 'subregion', 'timezones', 'emoji', 'emojiU', 'flag', 'wikiDataId'
    ];

    function states() {
        return $this->hasMany('App\Models\States');
    }

}
