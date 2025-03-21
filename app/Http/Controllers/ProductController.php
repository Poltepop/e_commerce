<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsInventory;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function product(request $request): Response
    {
        $keyword = $request->query('search');

        if($keyword){
            $product = $this->productService->search($keyword)->all();
        }else {
            $product = $this->productService->getproduct()->all();
        }

        $totalProducts = Product::get()->count();
        $productInventories = ProductsInventory::sum('qty');
        return response()->view('admin.products',[
            'title' => 'Products',
            'products' => $product,
            'totalProducts' => $totalProducts,
            'productInventories' => $productInventories,
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
        try{
            $product = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|decimal:2',
                'weight' => 'required|decimal:2',
                'short_description' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'in:active,inactive',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'qty' => 'int',
                'categories' => 'required|array'
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        $qty = $product['qty'];
        $category = $product['categories'];

        unset($product['image'], $product['categories'], $product['qty']);

        $path = $request->file('image')->storePublicly('products','public');


        $this->productService->saveProduct($product, $category, $path, $qty );

        return redirect()->action([ProductController::class, 'product']);
    }

    public function updateProduct(Request $request, string $slug): RedirectResponse
    {
        try{
            $product = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|decimal:2',
                'weight' => 'required|decimal:2',
                'short_description' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'in:active,inactive',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'qty' => 'int',
                'categories' => 'required|array'
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        $qty = $product['qty'];
        $categories = $product['categories'];

        unset($product['image'], $product['categories'], $product['qty']);

        $getProduct = Product::with('productImage')->where('slug', $slug)->first();
        $oldPath = $getProduct->productImage?->path ?? '';

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($oldPath)){
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->storePublicly('products','public');
        }

        $this->productService->updateProduct($slug,$product, $categories, $path, $qty);

        return redirect()->action([ProductController::class, 'product']);
    }

    public function removeProduct(int $id): RedirectResponse
    {
        $this->productService->removeProduct($id);
        return redirect()->action([ProductController::class, 'product']);
    }

}
