<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
   
    protected $fillable = [
        'event_id', 'ticket_type', 'name', 'quantity', 'price', 'start_date', 'end_date', 'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

   
}
 