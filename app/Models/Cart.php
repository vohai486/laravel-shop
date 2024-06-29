<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];
    function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
