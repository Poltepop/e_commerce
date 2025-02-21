<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function product(Request $request): Response
    {
        $product = $this->productService->getproduct();
        return response()->view('admin.posts',[
            'products' => $product
        ]);
    }

    public function addProductView(Request $request): Response
    {
       return response()->view('components.form-input');
    }
    
    public function updateProductView(Request $request, $id): Response
    {
        $product = Product::find($id);
        return response()->view('components.form-update', [
            'product'=> $product
        ]);
    }

    public function addProduct(Request $request): RedirectResponse
    {   
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'weight' => 'required|decimal:2',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $this->productService->saveProduct($product);

        return redirect()->action([ProductController::class, 'product']);
    }

    public function updateProduct(Request $request, int $id): RedirectResponse
    {
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'weight' => 'required|decimal:2',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $this->productService->updateProduct($id,$product);

        return redirect()->action([ProductController::class, 'product']);
    }

    public function removeProduct(Request $request, int $id): RedirectResponse
    {
        $this->productService->removeProduct($id);
        return redirect()->action([ProductController::class, 'product']);
    }

}
