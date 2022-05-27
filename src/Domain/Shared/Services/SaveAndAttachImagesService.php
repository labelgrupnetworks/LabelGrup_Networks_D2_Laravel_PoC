<?php

namespace Domain\Shared\Services;

use Domain\Images\Models\Image;
use Domain\Shared\Interfaces\IHasImages;
use Illuminate\Support\Facades\Storage;

class SaveAndAttachImagesService
{
    public static function execute(IHasImages $imageableModel, array $images): void
    {
        foreach ($images as $image){
            $name = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs($imageableModel->directoryForImages() . '/' . $imageableModel->id, $name);
            $url = Storage::url($path);

            $imageCreated = Image::create([
                'name' => $name,
                'path' => $path,
                'url' => $url
            ]);

            $imageableModel->images()->attach($imageCreated);
        }
        $imageableModel->refresh();
    }
}
