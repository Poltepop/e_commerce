<?php 

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService {
    public function login(string $email, string $password){
        return Auth::attempt([
            "email" => $email,
            "password" => $password
        ]);
    }
}