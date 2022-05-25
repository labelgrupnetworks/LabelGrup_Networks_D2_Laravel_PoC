<?php

namespace App\Api\Products\Controllers;

use App\Api\Products\Resources\ProductCollection;
use App\Api\Products\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Domain\Categories\Models\Category;
use Domain\Products\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(): ProductCollection
    {
        $products = Product::all();
        return ProductCollection::make($products);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
