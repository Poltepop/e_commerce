<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login');  
    route::post('/login', 'doLogin');  
    route::post('/logout', 'doLogout');  
});
