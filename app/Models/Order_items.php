<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
   protected $guarded = [];

    public function orders()
    {
        return $this->belongsTo(Orders::class);
    }

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
