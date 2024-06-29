<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'address',
        'phone',
        'email',
        'note',
        'discount',
        'total_money',
        'coupon_info',
        'user_id',
        'status'
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
