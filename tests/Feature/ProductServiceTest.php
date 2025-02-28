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
       $this->seed(ProductSeeder::class);

       $product = $this->productService->getProduct();
       foreach ($product as $value) {
            self::assertEquals("1", $value['id']);
            self::assertEquals("SuperStar Jumbo", $value['name']);
       }
    }

    public function testGetProductEmpty(){
        self::assertCount(0,$this->productService->getProduct());
    }

    public function testGetProductNotEmpty(){
        $this->seed(ProductSeeder::class);

        self::assertCount(1, $this->productService->getProduct());
    }
    public function testRemoveProduct(){
        $this->seed(ProductSeeder::class);

        self::assertEquals(1, sizeof($this->productService->getProduct()));
        $this->productService->removeProduct(1);
        self::assertEquals(0, sizeof($this->productService->getProduct()));
    }

    public function testUpdateProduct(){
        $this->seed(ProductSeeder::class);
            $request = [
                'name' => 'updated',
                'price' => '10.00',
                'weight' => '10.00',
                'short_description' => null,
                'description' => null,
                'status' => 'active'
            ];
            
            $product = $this->productService->updateProduct('superstar-jumbo', $request);
            $product = $this->productService->getProduct();
            foreach ($product as $value) {
                self::assertEquals("1", $value->id);
                self::assertEquals("updated", $value->name);
                self::assertNotNull($value->slug);
           }
    }
}
