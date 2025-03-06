<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManyToManyTest extends TestCase
{
    use RefreshDatabase;

    public function testManyToMany() {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::find('1');
        self::assertNotNull($product);

        $product->productCategories()->attach(['1','2']);
        $category = $product->productCategories;
        self::assertCount(2, $category);

        self::assertEquals("FOOD", $category[0]->name);
    }

    public function testManyToManyDetach(){
        $this->testManyToMany();

        $product = Product::find('1');
        $product->productCategories()->detach('1');
        $category = $product->productCategories;
        self::assertCount(1, $category);
    }
}
