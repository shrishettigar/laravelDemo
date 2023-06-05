<?php
namespace App\Repositories\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Review;


class ProductRepository implements ProductRepositoryInterface{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function getByCategory($category)
    {
        return Product::where('category', $category)->get();
    }

    public function getByPriceRange($minPrice, $maxPrice) {
        return Product::whereBetween('price', [$minPrice, $maxPrice])->get();
    }
    
    public function getAvailableProducts() {
        return Product::where('availability', true)->get();
    }
    
    public function getAverageRating($productId) {
        return Review::where('product_id', $productId)->avg('rating');
    }
}
