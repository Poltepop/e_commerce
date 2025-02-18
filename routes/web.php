<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'home']);

Route::get('/homepage',function(){
    return view('homepage');
});

// Route::get('/posts',function(){
//     return view('posts');
// });

Route::controller(ProductController::class)->middleware(['OnlyMemberMiddleware'])->group(function (){
    route::get('/posts', 'product');
    route::get('/product', 'addAndUpdateProduct');
    route::get('/product/{id}/update', 'addAndUpdateProduct');
    route::post('/product', 'addProduct');
    route::post('/product/{id}/update', 'updateProduct');
    route::post('/product/{id}/delete', 'removeProduct');
});


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login')->middleware(['OnlyGuestMiddleware']);  
    route::post('/login', 'doLogin')->middleware(['OnlyGuestMiddleware']);  
    route::post('/logout', 'doLogout')->middleware(['OnlyMemberMiddleware']);  
});
