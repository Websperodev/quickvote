<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
   
    public $table = "company_informations";
    protected $fillable = [
        'vendor_id','company_name', 'address', 'city_id', 'state_id', 'country_id', 'phone', 'email', 'website', 'company_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

   
}
 