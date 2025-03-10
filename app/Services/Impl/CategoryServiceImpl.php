<?php

namespace App\Services\Impl;

use App\Models\Category;
use App\Services\CategoryService;

class CategoryServiceImpl implements CategoryService 
{
    public function saveCategory(array $category){
        $category = new Category($category);
        $category->save();
    }

    public function getCategory(){
        return Category::get();
    }

    public function removeCategory(int $id){
        $category = Category::find($id);
        if($category != null){
            $pivot = $category->pivot;
            $category->categoryProducts()->detach($pivot);

            $category->delete();
        }
    }
    
    public function updateCategory(string $slug, array $category){
        return Category::where('slug',$slug)->update($category);
    }
}