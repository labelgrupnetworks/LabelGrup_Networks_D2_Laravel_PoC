<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function index(): ImageCollection
    {
        return new ImageCollection(Image::cursorPaginate(50));
    }

    public function show(string $id): ImageResource
    {
        return new ImageResource(Image::findOrFail($id));
    }

    public function destroy(string $id): JsonResponse
    {
        $image = Image::findOrFail($id);

        $image->delete();

        return response()->json([
            'message' => 'Image has been deleted successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }
}
