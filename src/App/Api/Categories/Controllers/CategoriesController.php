<?php

namespace App\Api\Categories\Controllers;

use App\Api\Categories\Resources\CategoryCollection;
use App\Http\Controllers\Controller;
use Domain\Categories\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(): CategoryCollection
    {
        $categories = Category::all();
        return CategoryCollection::make($categories);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
