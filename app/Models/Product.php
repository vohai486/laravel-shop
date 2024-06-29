<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'thumb_image',
        'slug',
        'show_at_home',
        'status',
        'seo_description',
        'seo_title',
        'sku',
        'long_description',
        'short_description',
        'quantity',
        'price',
        'category_id',
        'name'
    ];
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    function options()
    {
        return $this->hasMany(ProductOption::class);
    }
    function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
