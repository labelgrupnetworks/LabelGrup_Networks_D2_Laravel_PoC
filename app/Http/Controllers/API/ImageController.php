<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

//Requests
use App\Http\Requests\Images\ImageCreateRequest;
use App\Http\Requests\Images\ImageEditRequest;
use App\Http\Requests\Images\ImageByIdRequest;
use App\Http\Requests\Images\ImageByProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function find() : JsonResponse
    {
        $images = Image::get();

        return response()->json([
            "success" => true,
            "data" => $images
        ], Response::HTTP_OK);
    }

    public function findByIdProduct(ImageByProductRequest $request) : JsonResponse
    {
        if($images = Image::where('id_product', '=', $request->validated())->get()) {
            return response()->json([
                "success" => true,
                "data" => $images
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false,
            "msg" => "No images found"
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product = null) : JsonResponse
    {
        $storagePath = 'public/images';
        $files = array();

        if ($request->has('images') && ($product || $request->has("id_product"))) {
            if(!Storage::exists($storagePath)) {
                Storage::makeDirectory($storagePath, 0775, true, true);
            }
            
            $files[] = $request->file('images');
            
            foreach ($files as $img) {
                $path = $img->storeAs($storagePath, $img->hashName());

                if(Image::create(['file' => $path, 'id_product' => ($product ? $product->id_product : $request->id_product)])) {
                    return response()->json([
                        "success" => true
                    ], Response::HTTP_OK);
                }
            }
        }

        return response()->json([
            "success" => false,
            "msg" => "Something went wrong"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function update(ImageEditRequest $request) : JsonResponse
    {
        $files = array();
        $storagePath = 'public/images';

        $validated = $request->validated();
        if($image = Image::find($validated["id_image"])) {
            if($request->has("images")) {
                $files[] = $request->file('images');

                foreach ($files as $img) {
                    $path = $img->storeAs($storagePath, $img->hashName());

                    $validated["file"] = $path;
                }
            }

            if($image->update($validated)) {
                return response()->json([
                    "success"=> true
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "success"=> false
        ], Response::HTTP_BAD_REQUEST);
    }

    public function delete(ImageByIdRequest $request) : JsonResponse
    {
        $request = $request->validated();
        
        if($image = Image::find($request["id_image"])) {
            if($image->delete()) {
                return response()->json([
                    "success"=> true
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "success"=> false,
            "msg"   => "Image not found",
        ], Response::HTTP_BAD_REQUEST);
    }
}
