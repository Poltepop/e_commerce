<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'ref',
        'status',
        'order_date',
        'base_total_price',
        'discount_amount',
        'discount_percent',
        'shipping_cost',
        'grand_total',
        'note'
    ];

}
