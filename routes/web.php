<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'home']);

Route::get('/homepage',function(){
    return view('admin.homepage',[
        'title' => 'Homepage',
    ]);
})->name('homepage');


Route::controller(ProductController::class)->middleware(['auth'])->group(function (){
    route::get('/products', 'product');
    route::get('/product/create', 'addProductView')->name('form.product');
    route::get('/product/{product:slug}/update', 'UpdateProductView')->name('form.update.product');
    route::post('/product/create', 'addProduct')->name('save.product');
    route::post('/product/{product:slug}/update', 'updateProduct')->name('update.product');
    route::post('/product/{id}/delete', 'removeProduct')->name('delete.product');
});


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login');
    route::get('/register', 'formRegisterView');  
    route::post('/register', 'register')->name('register');  
    route::post('/login', 'doLogin'); 
    route::post('/logout', 'doLogout');  
});

Route::controller(CategoryController::class)->middleware(['auth'])->group(function(){
    route::get('/categories','category');
    route::get('/category/create','addCategoryView')->name('form.input.category');
    route::get('/category/{category:slug}/update', 'updateCategoryView')->name('form.update.category');
    route::post('/category/create', 'addCategory')->name('save.category');
    route::post('/category/{category:slug}/update', 'updateCategory')->name('update.category');
    route::post('/category/{id}/delete', 'deleteCategory')->name('delete.category');
});

Route::controller(WishlistController::class)->middleware(['auth'])->group(function(){
    Route::get('/wishlist', 'wishlist');
    Route::post('/wishlist/add', 'addWishlist')->name('add.wishlist');
    Route::post('/wishlist/{id}/delete', 'deleteWishlist')->name('delete.wishlist');
});

Route::controller(CartController::class)->middleware(['auth'])->group(function(){
    Route::get('/carts', 'carts')->name('carts');
    Route::post('/carts/add', 'addCart')->name('add.cart');
});
