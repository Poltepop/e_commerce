<?php

namespace App\Services;

interface ProductService
{
    public function saveProduct(string $name, string $slug,string $price,string $weight,?string $short_description, ?string $description, string $status):void ;

    public function getProduct():array ;

    public function removeProduct(int $id);

    public function updateProduct(int $id,string $name, string $slug,string $price,string $weight,?string $short_description, ?string $description, string $status);
};