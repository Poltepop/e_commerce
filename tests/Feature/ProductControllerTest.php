<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CategorySeeder;
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
            'price' => 'The price field is required.',
            'weight' => 'The weight field is required.',
        ]);
    }

    public function testAddProductSuccess(){
        $this->seed(CategorySeeder::class);
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/create',[
            'name' => 'ayam',
            'price' => '10.00',
            'weight' => '10.00',
            'status' => 'active',
            'short_description' => 'halo',
            'description' => 'halo',
            'categories' => [
                1,
            ],
        ])->assertValid()->assertRedirect('/products');
    }

    public function testRemoveProduct(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/1/delete')->assertRedirect('/products');
    }

    public function testUpdateProductSuccess(){
        $this->seed(ProductSeeder::class);
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/ayam/update', [
            'name' => 'ayam',
            'price' => '10.00',
            'weight' => '10.00',
            'status' => 'active',
            'short_description' => 'halo',
            'description' => 'halo',
            'categories' => [
                1
            ],
        ])->assertValid()->assertRedirect('/products');
    } // Bug

    public function testUpdateProductFailed(){
        $this->seed(ProductSeeder::class);
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/product/superstar-jumbo/update',[])
        ->assertInvalid([
            'name' => 'The name field is required.',
            'price' => 'The price field is required.',
            'weight' => 'The weight field is required.',
        ]);
    }
}
