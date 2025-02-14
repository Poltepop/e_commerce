<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'home']);


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login')->middleware(['OnlyGuestMiddleware']);  
    route::post('/login', 'doLogin')->middleware(['OnlyGuestMiddleware']);  
    route::post('/logout', 'doLogout')->middleware(['OnlyMemberMiddleware']);  
});
