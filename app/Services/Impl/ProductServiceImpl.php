<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService
{
    public function saveProduct(string $name, string $slug,string $price,string $weight,?string $short_description, ?string $description, string $status): void
    {
        $product = new Product([
            'name' => "$name",
            'slug' => "$slug",
            'price' => "$price",
            'weight' => "$weight",
            'short_description' => "$short_description",
            'description' => "$description",
            'status' => $status,
        ]);

        $product->save();
    }
    
    public function getProduct(): array
    {
        return Product::query()->get()->toArray();
    }
}