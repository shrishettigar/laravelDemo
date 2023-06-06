<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    /**
     * Instantiate ProductRepository
     *
     * @param  ProductRepository  $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        // Retrieve all products from the database
        $products = $this->productRepository->getAll();
        return response()->json($products);
    }

     /**
     * Get all Categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCategories()
    {
         // Retrieve all Categories from the database
        $products = $this->productRepository->getAllCategories();
        return response()->json($products);
    }

    /**
     * Get a product by its ID.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductById($id)
    {   
        // Retrieve a product by its ID from the database
        $product = $this->productRepository->getById($id);
        return response()->json($product);
    }

    /**
     * Get products by category.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsByCategory(Request $request)
    {
        // Retrieve a product by its category from the database
        $category = $request->input('category');
        $products = $this->productRepository->getByCategory($category);
        return response()->json($products);
    }
}
