<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService; 

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);

       DB::delete('delete from users');
    }

    public function testLoginSuccess(){
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userService->login('eko@localhost','rahasia'));
    }

    public function testLoginUserNotFound(){
        $this->seed(UserSeeder::class);
        self::assertFalse($this->userService->login('eko','rahasia'));
    }
    
        public function testLoginWrongPassword(){
        $this->seed(UserSeeder::class);
        self::assertFalse($this->userService->login('eko@localhost','Salah'));
    }


}
