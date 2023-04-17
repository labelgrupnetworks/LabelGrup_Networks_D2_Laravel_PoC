<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;

use App\Models\api\v1\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasDirectPermission('get image'))
        {
            $images = Image::all();

            return response()->json([
                'status'    => true,
                'images'    => $images
            ]);
        } else {
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
        if($user->hasDirectPermission('create image'))
        {
            // Store the file inside storage
            $path = $request->file('url')->store('public/images');

            $image = Image::create([
                'imageable_id'  => $request->imageable_id,
                'imageable_type'  => $request->imageable_type,
                'description'  => $request->description,
                'url'   => $path
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Image uploaded successfully',
                'image'     => $image
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\v1\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\v1\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $image_id)
    {
        $user = Auth::user();
        if($user->hasDirectPermission('update image'))
        {
            // Store the file inside storage
            $image = Image::find($image_id);
            $path = $request->file('url')->store('public/images');


            $image->update([
                'description'  => $request->description,
                'url'   => $path
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Image updated successfully',
                'image'     => $image
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\v1\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $user = Auth::user();
        if($user->hasDirectPermission('delete image'))
        {
           // Check if file exists then delete record
            if(File::exists($image->url)) {
                File::delete($image->url);
            }

            $image->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Image deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }


    }
}
