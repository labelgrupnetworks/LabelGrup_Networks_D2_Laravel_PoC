<?php

namespace App\Api\Categories\Resources;

use Domain\Categories\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Category */
class CategoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'type' => $this->resource->getTable(),
            'id' => $this->resource->getRouteKey(),
            'attributes' => $this->resource->fields(),
            'relationships' => [
                'products' => [
                    'data' => $this->resource->getProducts()
                ],
                'images' => [
                    'data' => $this->resource->getImages()
                ]
            ],
            'links' => [
                'self' => route('api.categories.show', $this->resource)
            ]
        ];
    }
}
