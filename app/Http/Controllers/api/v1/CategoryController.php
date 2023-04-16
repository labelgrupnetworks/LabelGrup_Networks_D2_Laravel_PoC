<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;

use App\Models\api\v1\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasDirectPermission('get category'))
        {
            $categories = Category::all();

            return response()->json([
                'status'        => true,
                'categories'    => $categories
            ]);
        }else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($user->hasDirectPermission('create category'))
        {
            $category = Category::create($request->all());

            return response()->json([
                'status'    => true,
                'message'   => 'Category created successfully',
                'category'  => $category
            ], 200);
        }else{
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\v1\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\v1\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $user = Auth::user();

        if($user->hasDirectPermission('update category'))
        {
            $category->update($request->all());

            return response()->json([
                'status'    => true,
                'message'   => 'Category updated successfully',
                'category'  => $category
            ], 200);
        }else{
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\v1\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        if($user->hasDirectPermission('delete category'))
        {
            $category->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Category deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }


    }
}
