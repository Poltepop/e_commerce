<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productsImage extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'path',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
