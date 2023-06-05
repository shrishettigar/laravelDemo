<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesProductsReviewsTables extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('rating');
            $table->text('content');
            $table->timestamps();
        });

        // Seed categories
        DB::table('categories')->insert([
            ['name' => 'Category 1'],
            ['name' => 'Category 2'],
            ['name' => 'Category 3'],
        ]);

        // Seed products
        DB::table('products')->insert([
            ['name' => 'Product 1', 'description' => 'Description of Product 1', 'category_id' => 1, 'price' =>200],
            ['name' => 'Product 2', 'description' => 'Description of Product 2', 'category_id' => 2, 'price' =>300],
            ['name' => 'Product 3', 'description' => 'Description of Product 3', 'category_id' => 1, 'price' =>400],
            ['name' => 'Product 4', 'description' => 'Description of Product 4', 'category_id' => 3, 'price' =>150],
            ['name' => 'Product 5', 'description' => 'Description of Product 5', 'category_id' => 1, 'price' =>80],
            ['name' => 'Product 6', 'description' => 'Description of Product 6', 'category_id' => 2, 'price' =>1590],
            ['name' => 'Product 7', 'description' => 'Description of Product 7', 'category_id' => 1, 'price' =>800],
            ['name' => 'Product 8', 'description' => 'Description of Product 8', 'category_id' => 3, 'price' =>700],
            ['name' => 'Product 9', 'description' => 'Description of Product 9', 'category_id' => 1, 'price' =>650],
            ['name' => 'Product 10', 'description' => 'Description of Product 10', 'category_id' => 2, 'price' =>250],
        ]);

    }

    public function down()
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
}
