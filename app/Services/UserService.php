<?php 

namespace App\Services;

interface UserService {
    public function login(array $credentials);
}