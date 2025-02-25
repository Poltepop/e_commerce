<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'price',
        'weight',
        'short_description',
        'description',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = static::generateUniqueSlug($product->name);
        });
        
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
