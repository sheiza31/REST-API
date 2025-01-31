<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $guarded = [];


    /**
     * Get the user that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function Cart_items()
    {
        return $this->hasMany(Cart_items::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Order_items::class);
    }
}
