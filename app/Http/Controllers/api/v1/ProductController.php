<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;

use App\Models\api\v1\Product;
use App\Models\api\v1\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status'    => true,
            'products'  => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'status'    => true,
            'message'   => 'Product created successfully',
            'products'  => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\v1\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\v1\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'status'    => true,
            'message'   => 'Product updated successfully',
            'products'  => $product
        ], 200);
    }

    public function assignCategories($id, Request $request)
    {

        $product = Product::find($id)->first();
        foreach($request->categories as $c => $key){

            $is_main = $key['is_main'];
            $assign = $product->categories()->syncWithoutDetaching([$key['id'] =>   ['is_main' => $is_main]]);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Categories where modified for this product successfully',
            'product_category'  => $request->categories
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\v1\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Product deleted successfully'
        ], 200);
    }
}
