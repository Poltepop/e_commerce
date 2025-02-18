<?php

namespace Tests\Feature;

use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testProduct(){
        $this->seed(ProductSeeder::class);

        $this->withSession([
            "email" => "eko@localhost",
        ])->get('/posts')
        ->assertSeeText('SuperStar Jumbo');
    }
}
