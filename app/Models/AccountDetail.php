<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    public $table = "account_details";
    protected $fillable = [
        'vendor_id','account_holder_name', 'account_number', 'bank_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

   
}
 