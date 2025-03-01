<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'home']);

Route::get('/homepage',function(){
    return view('admin.homepage',[
        'title' => 'Homepage',
    ]);
});

// Route::get('/posts',function(){
//     return view('posts');
// });

Route::controller(ProductController::class)->middleware(['OnlyMemberMiddleware'])->group(function (){
    route::get('/products', 'product');
    route::get('/product/create', 'addProductView')->name('form.product');
    route::get('/product/{product:slug}/update', 'UpdateProductView')->name('form.update.product');
    route::post('/product/create', 'addProduct')->name('save.product');
    route::post('/product/{id}/update', 'updateProduct')->name('update.product');
    route::post('/product/{product:slug}/delete', 'removeProduct')->name('delete.product');
});


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login')->middleware(['OnlyGuestMiddleware']);  
    route::post('/login', 'doLogin')->middleware(['OnlyGuestMiddleware']);  
    route::post('/logout', 'doLogout')->middleware(['OnlyMemberMiddleware']);  
});

Route::controller(CategoryController::class)->middleware(['OnlyMemberMiddleware'])->group(function(){
    route::get('/categories','category');
    route::get('/category/create','addCategoryView')->name('form.input.category');
});
