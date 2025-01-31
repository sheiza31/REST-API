<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = "carts";
    protected $guarded = [];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke CartItem
    public function Cart_items()
    {
        return $this->hasMany(Cart_items::class,'cart_id');
    }
}
