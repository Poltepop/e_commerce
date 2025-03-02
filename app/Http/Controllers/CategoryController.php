<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function category(){
        $category = $this->categoryService->getCategory();
        return response()->view('admin.category',[
            'title' => 'Category',
            'categories'=> $category,
        ]);
    }

    public function addCategoryView() {
        return response()->view('components.form-input-category',[
            'title' => 'Add Category',
        ]);
    }

    public function addCategory(Request $request){
        $category = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $this->categoryService->saveCategory($category);

        return redirect()->action([CategoryController::class, 'category']);
    }

    public function updateCategoryView($slug){
        $category = Category::where('slug', $slug)->first();
        return response()->view('components.form-update-category', [
            'title' => 'Update Category',
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request, string $slug){
        $category = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->updateCategory($slug,$category);

        return redirect()->action([CategoryController::class, 'category']);
    }
}
