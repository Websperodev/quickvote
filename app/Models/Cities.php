<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model {

    protected $fillable = [
        'name', 'state_id', 'state_code', 'country_id', 'country_code', 'latitude', 'longitude', 'flag', 'wikiDataId'
    ];

    function states() {
        return $this->belongsTo('App\Models\States', 'state_id');
    }

}
