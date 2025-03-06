<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\products_images;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function product(): Response
    {
        $product = $this->productService->getproduct()->all();
        // dd($product);
        return response()->view('admin.products',[
            'title' => 'Products',
            'products' => $product,
        ]);
    }

    public function addProductView(): Response
    {
       $categories = $this->categoryService->getCategory();
       return response()->view('components.form-input',[
        'categories' => $categories,
        'title' => 'Form-Create'
       ]);
    }
    
    public function updateProductView($slug): Response
    {
        $product = Product::where('slug', $slug)->first();
        $categories = $this->categoryService->getCategory();
        $selectedCategories = $product->productCategories->pluck('id')->toArray();
        return response()->view('components.form-update', [
            'title' => 'Form-Update',
            'product'=> $product,
            'categories'=> $categories,
            'selectedCategory' => $selectedCategories,
        ]);
    }

    public function addProduct(Request $request): RedirectResponse
    {   
        $product = $request->validate([
            'name' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'weight' => 'required|decimal:2',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        unset($product['image']);

        $path = $request->file('image')->storePublicly('products','public');
        

        $category = $request->validate([
            'categories' => 'required|array',
        ]);
        
        $this->productService->saveProduct($product, $category['categories'], $path );

        return redirect()->action([ProductController::class, 'product']);
    }

    public function updateProduct(Request $request, string $slug): RedirectResponse
    {
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'weight' => 'required|decimal:2',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        unset($product['image']);

        $getProduct = Product::with('productImage')->where('slug', $slug)->first();
        $oldPath = $getProduct->productImage->path;

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($oldPath)){
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->storePublicly('products','public');
        }


        $categories = $request->validate([
            'categories' => 'required|array',
        ]);

        $this->productService->updateProduct($slug,$product, $categories['categories'], $path);

        return redirect()->action([ProductController::class, 'product']);
    }

    public function removeProduct(int $id): RedirectResponse
    {
        $this->productService->removeProduct($id);
        return redirect()->action([ProductController::class, 'product']);
    }

}
