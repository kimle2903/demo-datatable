<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class CustomerAddress extends Model
{
    protected $table = 'customer_address';

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
