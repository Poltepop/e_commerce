<?php 

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService {
    public function login(array $credentials){
        return Auth::attempt($credentials);
    }

    public function register(array $credentials){
        return User::create($credentials);
    }
}