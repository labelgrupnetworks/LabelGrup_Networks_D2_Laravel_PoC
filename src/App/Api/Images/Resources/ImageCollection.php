<?php

namespace App\Api\Images\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Domain\Images\Models\Image */
class ImageCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('api.images.index'),
            ],
            'meta' => [
                'images_count' => $this->collection->count()
            ]
        ];
    }
}
