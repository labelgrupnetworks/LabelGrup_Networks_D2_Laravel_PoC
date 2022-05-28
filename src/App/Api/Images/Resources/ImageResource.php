<?php

namespace App\Api\Images\Resources;

use Domain\Images\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Image */
class ImageResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->resource->getTable(),
            'id' => $this->resource->getRouteKey(),
            'attributes' => $this->resource->fields(),
            'relationships' => [
                'categories' => [
                    'data' => $this->resource->getCategories()
                ],
                'products' => [
                    'data' => $this->resource->getProducts()
                ]
            ],
            'links' => [
                'self' => route('api.images.show', $this->resource)
            ]
        ];
    }
}
