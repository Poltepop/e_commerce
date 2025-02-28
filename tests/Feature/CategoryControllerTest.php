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
}
