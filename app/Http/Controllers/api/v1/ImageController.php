<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;

use App\Models\api\v1\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\Helpers;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\v1\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {

        $isAdmin = Helpers::isAdmin();
        if($isAdmin){
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
                'message'   => 'Only Administrador or Moderador rol can delete'
            ], 200);
        }


    }
}
