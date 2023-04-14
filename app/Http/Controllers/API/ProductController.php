<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

//Requests
use App\Http\Requests\Products\ProductCreateRequest;
use App\Http\Requests\Products\ProductEditRequest;
use App\Http\Requests\Products\ProductByIdRequest;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function find() : JsonResponse
    {
        $products = Product::get();

        return response()->json([
            "success" => true,
            "data" => $products
        ], Response::HTTP_OK);
    }

    public function findOne(ProductByIdRequest $request) : JsonResponse
    {
        $request = $request->validated();

        if($product = Product::findOrFail($validated["id_product"])) {
            return response()->json([
                "success" => true,
                "data" => $product
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false,
            "msg" => "No product found"
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request) : JsonResponse
    {
        $validated = $request->safe()->merge(['id_user' => Auth::id()])->except(["secondary_categories"]);
        
        if($product = Product::create($validated)) {
            return response()->json([
                "success" => true
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false,
            "msg" => "Something went wrong"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function edit(ProductEditRequest $request) : JsonResponse
    {
        $validated = $request->validated();

        if($product = Product::findOrFail($validated["id_product"])) {
            $product->fill($validated);

            if($product->save()) {
                return response()->json([
                    "success"=> true
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "success"=> false
        ], Response::HTTP_BAD_REQUEST);
    }

    public function delete(ProductByIdRequest $request) : JsonResponse
    {
        $request = $request->validated();

        $product = Product::findOrFail($request["id_product"]);

        if($product->delete()) {
            return response()->json([
                "success"=> true
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success"=> false,
            "msg"   => "Product not found",
        ], Response::HTTP_BAD_REQUEST);
    }
}
