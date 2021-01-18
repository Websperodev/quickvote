<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Event extends Authenticatable
{
    use Notifiable, HasRoles;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'organizer_name', 'category_id', 'start_date', 'end_date', 'venue', 'city_id', 'state_id', 'country_id', 'timezone', 'description', 'user_id','event_priority'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class,'country_id');
    }

    
}
