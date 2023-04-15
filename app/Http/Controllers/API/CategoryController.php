<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

//Requests
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryEditRequest;
use App\Http\Requests\Category\CategoryByIdRequest;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function find() : JsonResponse
    {
        $categories = Category::get();

        return response()->json([
            "success" => true,
            "data" => $categories
        ], Response::HTTP_OK);
    }

    public function findOne(CategoryByIdRequest $request) : JsonResponse
    {
        $request = $request->validated();

        if($categories = Category::where("id_category", "=", $request["id_category"])->first()) {
            return response()->json([
                "success" => true,
                "data" => $categories
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false,
            "msg" => "No category found"
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request) : JsonResponse
    {
        if($category = Category::create($request->validated())) {
            return response()->json([
                "success" => true
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false,
            "msg" => "Something went wrong"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function update(CategoryEditRequest $request) : JsonResponse
    {
        $validated = $request->validated();

        if($category = Category::find($validated["id_category"])) {
            $category->fill($validated);

            if($category->save()) {
                return response()->json([
                    "success"=> true
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "success"=> false
        ], Response::HTTP_BAD_REQUEST);
    }

    public function delete(CategoryByIdRequest $request) : JsonResponse
    {
        $request = $request->validated();
        
        if($category = Category::find($request["id_category"])) {
            if($category->delete()) {
                return response()->json([
                    "success"=> true
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "success"=> false,
            "msg"   => "Category not found",
        ], Response::HTTP_BAD_REQUEST);
    }
}
