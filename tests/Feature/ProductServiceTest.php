<?php

namespace Tests\Feature;

use App\Services\ProductService;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
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
    }
}
