<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PricingPlans extends Model
{
   
    protected $fillable = [
        'plan_type', 'plan_amount', 'plan_heading', 'plan_features', 'button_text'
    ];

   
    
}
