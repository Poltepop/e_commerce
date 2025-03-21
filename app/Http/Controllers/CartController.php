<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    public function carts(Request $request) {
        $keyword = $request->query('search');
        if ($keyword !== null) {
            Cart::$keyword = $keyword;
        }
        $searchResult = Cart::with(['cartItems', 'userCart'])
            ->whereHas('cartItems', function($query) use ($keyword){
                $query->where('name', 'LIKE', "%$keyword%");
        })->get();

        if ($keyword !== null) {
            // dd($searchResult->all());
        }

        $carts = Cart::with(['cartItems', 'userCart'])->get();
        return Response()->view('admin.carts', [
            'title' => 'carts',
            'carts' => empty($keyword) ? $carts : $searchResult,
        ]);
    }

    public function addCart(Request $request){
        try{
            $product = $request->validate([
                'id' => 'required'
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        $userId = Auth::user()->id;
        $cart = Cart::where('user_id', $userId)->first();
        $productId = $product['id'];
        $duplicate = DB::table('cart_items')
        ->where('product_id', $productId)
        ->where('cart_id', $cart?->id)->exists();

        if($duplicate){
            return back()->withErrors([
                'duplicate' => 'Product is alr in cart'
            ]);
        }


        if($cart){
            $this->cartService->addCartItmes($product['id'], $cart->id);
        }else{
            $this->cartService->addCart($userId);
            $cartId = $cart?->id;
            $this->cartService->addCartItmes($productId, $cartId);
        }



        return redirect()->action([CartController::class, 'carts']);

    }

    public function deleteCart($id){
        $this->cartService->removeCartItems($id);
        return redirect()->action([CartController::class, 'carts']);
    }
}
