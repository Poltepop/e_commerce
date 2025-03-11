<?php 

namespace App\Services;

interface WishlistService {
    public function saveWishlist(array $wishlist, int $userid);

    public function removeWishlist();
}