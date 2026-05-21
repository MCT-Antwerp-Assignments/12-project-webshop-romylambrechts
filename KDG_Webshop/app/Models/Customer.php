<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'street',
        'nr',
        'zip',
        'box',
        'city',
        'country'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

