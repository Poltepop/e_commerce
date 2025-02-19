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

    public function testAddProductFailed(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/create',[])->assertInvalid([
            'name' => 'The name field is required.',
            'slug' => 'The slug field is required.',
            'price' => 'The price field is required.',
            'weight' => 'The weight field is required.',
            'status' => 'The status field is required.',
        ]);
    }

    public function testAddProductSuccess(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/create',[
            'name' => 'ayam',
            'slug' => 'ayam',
            'price' => '10.00',
            'weight' => '10.00',
            'status' => 'active',
            'short_description' => 'halo',
            'description' => 'halo',
        ])->assertValid()->assertRedirect('/posts');
    }
}
