<?php

namespace Tests\Feature;

use App\Services\ProductService;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    private ProductService $productService;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = $this->app->make(ProductService::class);
    }

    public function testSample(){
        self::assertNotNull($this->productService);
    }   

    public function testSaveProducts(){
       $this->productService->saveProduct("Mie Ayam","mie-ayam","10.000","5.5",null,null,"active");

       $product = $this->productService->getProduct();
       foreach ($product as $value) {
            self::assertEquals("1", $value['id']);
            self::assertEquals("Mie Ayam", $value['name']);
       }
    }

    public function testGetProductEmpty(){
        self::assertEquals([],$this->productService->getProduct());
    }

    public function testGetProductNotEmpty(){
        $this->productService->saveProduct("Mie Ayam","mie-ayam","10.000","5.5",null,null,"active");

        self::assertCount(1, $this->productService->getProduct());
    }
}
