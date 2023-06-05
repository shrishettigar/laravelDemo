<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        $products = $this->productRepository->getAll();
        return response()->json($products);
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->getById($id);
        return response()->json($product);
    }

    public function getProductsByCategory(Request $request)
    {
        $category = $request->input('category');
        $products = $this->productRepository->getByCategory($category);
        return response()->json($products);
    }
}
