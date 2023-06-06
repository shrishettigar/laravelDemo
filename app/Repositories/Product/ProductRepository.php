<?php
namespace App\Repositories\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;


class ProductRepository implements ProductRepositoryInterface{

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Product[]
     */
    public function getAll()
    {
        return Product::with('category')->get();
    }

    /**
     * Get a product by its ID.
     *
     * @param  int  $productId
     * @return Product|null
     */
    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    //Get product by a specific category
    public function getByCategory($category)
    {
        return Product::where('category', $category)->get();
    }

    //Gegt products within a price range
    public function getByPriceRange($minPrice, $maxPrice) {
        return Product::whereBetween('price', [$minPrice, $maxPrice])->get();
    }
    
    //Get products which are available
    public function getAvailableProducts() {
        return Product::where('is_available', true)->get();
    }
    
    //Get average rating of proucts
    public function getAverageRating($productId) {
        return Review::where('product_id', $productId)->avg('rating');
    }

    //Get all the categories
    public function getAllCategories()
    {
        return Category::all();
    }

}
