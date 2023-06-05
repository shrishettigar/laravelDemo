<?php
namespace App\Repositories\Product;
interface ProductRepositoryInterface {
    public function getAll();
    public function getById($id);
    public function getByCategory($categoryId);
    public function getByPriceRange($minPrice, $maxPrice);
    public function getAvailableProducts();
    public function getAverageRating($productId);
}