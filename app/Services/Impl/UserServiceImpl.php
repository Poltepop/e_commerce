<?php 

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService {
    public function login(array $credentials){
        return Auth::attempt($credentials);
    }
}