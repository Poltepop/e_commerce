<?php

namespace App\Services;

interface CategoryService 
{
    public function saveCategory(array $category);

    public function getCategory();

    public function removeCategory(int $id);
    
    public function updateCategory(string $slug, array $category);
}