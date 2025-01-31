<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_items extends Model
{
   protected $table = "cart_items";
   protected $guarded = [];

    // Relasi ke Cart
    public function carts()
    {
        return $this->belongsTo(Carts::class,'cart_id');
    }

    // Relasi ke Product
    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
