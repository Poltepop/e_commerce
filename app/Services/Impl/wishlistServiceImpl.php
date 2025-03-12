<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Models\User;
use App\Services\WishlistService;

class wishlistServiceImpl implements WishlistService {
    public function saveWishlist(array $wishlist, int $userid){
        $user = User::find($userid);
        $user->productsWishlists()->syncWithoutDetaching($wishlist);
    }

    public function getWishlist(){
        return User::with('productsWishlists')->get();
    }

    public function removeWishlist(int $id){
        $products = Product::find($id);
        if($products != null){
            $pivot = $products->pivot;
            // return dd($pivot);
            return $products->productsWishlists()->detach($pivot);
        }
    }
}