<?php

namespace App\Services;

use Illuminate\Support\Arr;

interface ProductService
{
    public function saveProduct(array $product,array $categories,string $path,int $qty);

    public function getProduct() ;

    public function removeProduct(int $id);

    public function updateProduct(string $slug, array $product, array $categories, string $path, int $qty);

    public function search(string $keyword);
};