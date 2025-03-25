<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function orders(){
        return response()->view('admin.orders', [
            'title' => 'orders'
        ]);
    }

    public function addOrdersView(){
        $products = Product::with('productInventory')->get();
        $users = User::get();
        return response()->view('components.form-input-order', [
            'title' => 'add orders',
            'users' => $users,
            'products' => $products
        ]);
    }
}
