<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function product(Request $request)
    {
        $product = $this->productService->getproduct();
        return response()->view('posts',[
            'products' => $product
        ]);
    }

    public function addAndUpdateProduct()
    {

    }

    public function addProduct(Request $request)
    {

    }

    public function updateProduct(Request $request, int $id)
    {

    }

    public function removeProduct(Request $request)
    {

    }

}
