<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $table = 'categories';
    protected $fillable = [
        'name', 'description', 'created_by', 'image'
    ];

    public function parent() {
        return $this->belongsTo('App\Models\Categories', 'parent_id', 'id');
    }

  

}
