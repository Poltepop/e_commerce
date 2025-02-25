<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService
{
    public function saveProduct(array $product): void
    {
        $product = new Product($product);
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

    public function updateProduct(string $slug,array $product)
    {
        return Product::where('slug',$slug)->update($product);
    }
}