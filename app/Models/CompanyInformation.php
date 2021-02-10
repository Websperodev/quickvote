<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
   
    public $table = "company_informations";
    protected $fillable = [
        'vendor_id','company_name', 'address', 'city_id', 'state_id', 'country_id', 'phone', 'email', 'website', 'company_description'
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class,'id','vendor_id');
    }
    

   
}
 