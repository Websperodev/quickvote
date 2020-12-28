<?php

namespace App\Models;


class ModelHasRoles extends Model
{
    use Notifiable, HasRoles;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'model_type', 'email', 'model_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   
}
