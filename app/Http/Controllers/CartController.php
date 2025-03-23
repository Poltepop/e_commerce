<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductsInventory;
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
            $carts = Cart::with(['cartItems', 'userCart'])->get();
        }

        $totalCart = DB::table('cart_items')->get()->count();
        $carts = Cart::with(['cartItems', 'userCart'])->get();
        return Response()->view('admin.carts', [
            'title' => 'carts',
            'carts' => $carts,
            'totalCarts' => $totalCart
        ]);
    }

    public function addCartView($id){
        $product = DB::table('products')->where('id', $id)->first();
        return response()->view('components.form-input-cart', [
            'title' => 'add cart',
            'product' => $product
        ]);
    }

    public function addCart(Request $request){
        try{
            $variant = $request->validate([
                'id' => 'required',
                'qty' => 'required|int',
                'size' => 'nullable|string|max:10',
                'colors' => 'nullable|string|max:100'
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        $variantDetail = [
            'colors' => $variant['colors'],
            'size' => $variant['size'],
        ];

        
        $productQty = $variant['qty'];
        $productId = $variant['id'];
        $productInvent = ProductsInventory::where('product_id', $productId)->first()->qty;  

        if($productQty > $productInvent){
            return back()->withErrors([
                'enough' => 'Stock is not enough'
            ]);
        }

        unset($variant['qty'], $variant['id']);

        $userId = Auth::user()->id;
        $cart = Cart::where('user_id', $userId)->first();
        $duplicate = DB::table('cart_items')
        ->where('product_id', $productId)
        ->where('cart_id', $cart?->id)->exists();

        if($duplicate){
            return back()->withErrors([
                'duplicate' => 'Product is alr in cart'
            ]);
        }


        if($cart != null){
            $this->cartService->addCartItmes($productId, $cart->id, $productQty, $variantDetail);
        }else{
            $this->cartService->addCart($userId);
            $cart = Cart::where('user_id', $userId)->first();
            $cartId = $cart->id;
            $this->cartService->addCartItmes($productId, $cartId, $productQty, $variantDetail);
        }



        return redirect()->action([CartController::class, 'carts']);

    }

    public function deleteCart($id){
        $this->cartService->removeCartItems($id);
        return redirect()->action([CartController::class, 'carts']);
    }
}
