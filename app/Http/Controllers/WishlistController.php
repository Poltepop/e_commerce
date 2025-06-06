<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
   private WishlistService $wishlistService;

   public function __construct(WishlistService $wishlistService) {
    $this->wishlistService = $wishlistService;
   }

    public function wishlist(Request $request){

        $keyword = $request->query('search');
        $totalWishlists = DB::table('wishlists')->get()->count();
 
        if($keyword != null ){
            $products = $this->wishlistService->searchWishlist($keyword);
        }else{
            $products =  $this->wishlistService->getWishlist();
        }

        return response()->view('admin.wishlist', [
            'title' => 'Wishlist',
            'products' => $products,
            'totalWishlists' => $totalWishlists,
        ]);
    }

    public function addWishlist(Request $request){
       try{
        $wishlist = $request->validate([
            'check' => 'required|array',
            'user' => 'required',
        ]);
       }catch(ValidationException $e){
        $firstError = $e->validator->errors()->first();
        return back()->withErrors([
            'required' => $firstError
        ]);
       }

       $userid = $wishlist['user'];
       unset($wishlist['user']);

       $this->wishlistService->saveWishlist($wishlist['check'], $userid);
       return redirect()->action([WishlistController::class, 'wishlist']);
    }

    public function deleteWishlist($id){
        $this->wishlistService->removeWishlist($id);
        return redirect()->action([WishlistController::class, 'wishlist']);
    }
}
