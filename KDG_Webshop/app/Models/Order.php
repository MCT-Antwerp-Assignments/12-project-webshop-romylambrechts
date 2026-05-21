<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    protected $fillable = [
        'customer_id',
        'paid',
        'total_price',
        'mollie_id'
    ];
}
