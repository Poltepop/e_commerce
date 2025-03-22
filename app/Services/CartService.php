<?php

namespace App\Services;


interface CartService{
    public function addCart(int $userId);

    public function addCartItmes(int $productId, int $cartId, int $qty, ?array $variant);

    public function removeCartItems(int $id);
    
}