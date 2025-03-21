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

    public function addCartItmes(int $productId, int $cartId){
        $cart = Cart::find($cartId);
        return $cart->cartItems()->attach($productId);
    }

    public function removeCartItems(int $id) {
        return DB::table('cart_items')->where('id', $id)->delete();
    }

    public function searchCart(string $keyword){
        Cart::$keyword = $keyword;

        return Cart::with(['cartItems', 'userCart'])
        ->whereHas('cartItems', function($query) use ($keyword){
            $query->where('name', 'LIKE', "%$keyword%");
        })->get();
    }

}