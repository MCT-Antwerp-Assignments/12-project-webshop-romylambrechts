<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
