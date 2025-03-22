<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Cart extends Model
{
    // use HasUlids;
    public static ?string $keyword = null;
    protected $fillable = [
        'user_id',
        'cart_id',
        'qty',
        'variant',

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
        if (self::$keyword) {
            return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')->withPivot('id')->where('name', 'LIKE', '%' . self::$keyword. '%');
        } else {
            return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')->withPivot('id');
        }
    }
}
