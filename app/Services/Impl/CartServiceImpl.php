<?php

namespace App\Services\Impl;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class CartServiceImpl implements CartService {
    public function addCart(int $userId){
        return Cart::create([
            'user_id' => $userId
        ]);
    }

    public function addCartItmes(int $productId, int $cartId, int $qty, ?array $variant){
        $cart = Cart::find($cartId);
        return $cart->cartItems()->attach($productId, [
            'qty' => $qty,
            'variant' =>  json_encode($variant)
        ]);
    }

    public function removeCartItems(int $id) {
        return DB::table('cart_items')->where('id', $id)->delete();
    }
}