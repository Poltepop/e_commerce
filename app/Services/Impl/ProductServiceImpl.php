<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService
{
    public function saveProduct(array $product, array $categories): void
    {
        $product = Product::create($product);

        $product->productCategories()->attach($categories);
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
            $product->productCategories;
            $pivot = $product->pivot;
            $product->productCategories()->detach($pivot);
            $product->delete();
        }
    }

    public function updateProduct(string $slug,array $product, array $categories)
    {
        Product::where('slug',$slug)->update($product);
        $product = Product::where('slug', $slug)->first();
        $product->productCategories()->sync($categories);

    }

}