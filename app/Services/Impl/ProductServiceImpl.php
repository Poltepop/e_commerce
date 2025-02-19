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
    
    public function getProduct()
    {
        // return Product::query()->get()->toArray();
        return Product::query()->get();
    }

    public function removeProduct(int $id)
    {
        $product = Product::query()->find($id);
        if($product != null){
            $product->delete();
        }
    }

    public function updateProduct(int $id,string $name, string $slug,string $price,string $weight,?string $short_description, ?string $description, string $status)
    {
        $product = Product::query()->find($id);
        if($product != null){
            $product->name = $name;
            $product->slug = $slug;
            $product->price = $price;
            $product->weight = $weight;
            $product->short_description = $short_description;
            $product->description = $description;
            $product->status = $status;
            $product->update();
        }
    }
}