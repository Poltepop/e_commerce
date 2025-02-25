<?php

namespace App\Services;

interface ProductService
{
    public function saveProduct(array $product,):void ;

    public function getProduct() ;

    public function removeProduct(int $id);

    public function updateProduct(string $slug, array $product);
};