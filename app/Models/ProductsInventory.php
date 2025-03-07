<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductsInventory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'qty',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
