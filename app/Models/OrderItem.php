<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'title',
        'price',
        'name',
        'variant',
        'qty',
    ];
    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function product()
    {
        return $this->belongsTo(Product::class);
    }

}
