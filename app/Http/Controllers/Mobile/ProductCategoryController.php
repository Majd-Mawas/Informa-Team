<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCollection;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductCategoryCollection(ProductCategory::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }

    /**
     * Get products by category.
     */
    public function products(ProductCategory $productCategory)
    {
        return new ProductCollection($productCategory->products);
    }
    
    /**
     * Get categories that have products.
     */
    public function withProducts()
    {
        $categoriesWithProducts = ProductCategory::has('products')->get();
        return new ProductCategoryCollection($categoriesWithProducts);
    }
}