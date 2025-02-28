<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\CategoryService;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoryService $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryService = $this->app->make(CategoryService::class);
    }

    public function testSample(){
        self::assertNotNull($this->categoryService);
    }

    public function testGetCategory(){
        $this->seed(CategorySeeder::class);

        $categories = $this->categoryService->getCategory();
        self::assertNotNull($categories);
        foreach($categories as $category){
            self::assertEquals('FOOD',$category->name);
            self::assertEquals('food',$category->slug);
        }
    }

    public function testGetProductCategoryEmpty(){
        self::assertCount(0, $this->categoryService->getCategory());
    }

    public function testAddCategory(){
        $data = [
            'name' => 'FOOD',
            'slug' => 'food',
        ];

        $this->categoryService->saveCategory($data);
        $getCategory = $this->categoryService->getCategory();
        self::assertNotNull($getCategory);
    }

    public function testUpdateCategory() {
        $this->seed(CategorySeeder::class);

        $request = [
            'name' => 'updated',
            'slug' => 'updated-slug',
        ];

        $this->categoryService->updateCategory('food', $request);
        $getCategory = $this->categoryService->getCategory();
        self::assertNotNull($getCategory);

        foreach ($getCategory as $Category){
            self::assertEquals('updated', $Category->name);
            self::assertEquals('updated-slug', $Category->slug);
        }
    }

    public function testRemoveCategory(){
        $this->seed(CategorySeeder::class);

        $this->categoryService->removeCategory('1');
        $getCategory = $this->categoryService->getCategory();
        self::assertCount(0, $getCategory);
    }
}
