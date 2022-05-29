<?php

namespace App\Api\Images\Controllers;

use App\Api\Images\Resources\ImageCollection;
use App\Api\Images\Resources\ImageResource;
use App\Http\Controllers\Controller;
use Domain\Images\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ImageController extends Controller
{
    public function index(): ImageCollection
    {
        $images = Image::applySorts(request('sort'))
            ->applyFilters()
            ->jsonPaginate();

        return ImageCollection::make($images);
    }

    public function show(Image $image): ImageResource
    {
        return ImageResource::make($image);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Image $image): JsonResponse
    {
        Storage::delete($image->path);

        $image->deleteOrFail();

        return response()->json([
            'message' => 'Image has been deleted',
        ]);
    }
}
