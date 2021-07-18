<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerAddress;
class Customer extends Model
{
   
    protected $table = 'customers';
    protected $fillable = [
        'full_name', 'description', 'profile_img_url', 'status', 'notify', 'currency'
    ];
    public function customerAddress(){
        return $this->hasMany(CustomerAddress::class);
    }

    public function accounts()
    {
        return $this->morphOne(User::class, 'accountable');
    }

    
}
