<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testCategory(){
        $this->seed(CategorySeeder::class);

        $this->withSession([
            'email' => 'eko@localhost'
        ])->get('/categories')->assertSeeText('FOOD');
    }

    public function testAddViewCategory(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->get('/category/create')->assertSeeText('Add Category');
    }

    public function testAddCategoryControllerSuccess(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/category/create',[
            'name' => 'dummy test'
        ])->assertRedirect('/categories');
    }

    public function testAddCategoryControllerFailed(){
        $this->withSession([
            'email' => 'eko@localhost'
        ])->post('/category/create',[])
        ->assertInvalid([
            'name' => 'The name field is required.'
        ]);
    }
}
