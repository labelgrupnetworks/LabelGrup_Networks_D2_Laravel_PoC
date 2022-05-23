<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $images = Image::all();

        return response()->json([
            'status'    => true,
            'images'    => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImageRequest  $request
     * @return Response
     */
    public function store(ImageRequest $request)
    {
        // Store file inside storage
        $path = $request->file('url')->store('public/images');

        $image = Image::create([
            'name'  => $request->name,
            'url'   => $path
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Image created and uploaded successfully',
            'image'     => $image
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Image  $image
     * @return Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Image  $image
     * @return Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ImageRequest  $request
     * @param  Image  $image
     * @return Response
     */
    public function update(ImageRequest $request, Image $image)
    {
        // Store file inside storage
        $path = $request->file('url')->store('public/images');

        $image->update([
            'name'  => $request->name,
            'url'   => $path
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Image updated and uploaded successfully',
            'image'     => $image
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Image  $image
     * @return Response
     */
    public function destroy(Image $image)
    {
        if(File::exists($image->url)) {
            File::delete($image->url);
        }

        $image->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Image deleted successfully'
        ], 200);
    }
}
