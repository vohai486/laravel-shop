<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty',
        'variant_id'
    ];
    function product()
    {
        return $this->belongsTo(Product::class);
    }
    function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'id');
    }

    function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
