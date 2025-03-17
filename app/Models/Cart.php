<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Cart extends Model
{
    // use HasUlids;
    protected $fillable = [
        'user_id',
        'cart_id',
    ];

    public $timestamps = false;
    
    protected static function boot(){
        parent::boot();

        static::creating(function ($cart) {
            $cart->cart_id = Str::uuid();
        });
    }

    public function userCart() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cartItems(){
        return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')->withPivot('id');
    }
}
