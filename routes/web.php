<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(UserController::class)->group(function(){
    route::get('/login', 'login')->middleware(['OnlyGuestMiddleware']);  
    route::post('/login', 'doLogin')->middleware(['OnlyGuestMiddleware']);  
    route::post('/logout', 'doLogout')->middleware(['OnlyMemberMiddleware']);  
});
