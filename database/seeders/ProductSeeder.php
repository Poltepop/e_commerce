<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = new Product();
        $product->name = "SuperStar Jumbo";
        $product->slug = "superstar-jumbo";
        $product->price = "10.000";
        $product->weight = "5.5";
        $product->status = "active";
        $product->save();
    }
}
