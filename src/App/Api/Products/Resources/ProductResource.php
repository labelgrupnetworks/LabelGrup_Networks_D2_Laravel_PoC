<?php

namespace App\Api\Products\Resources;

use Domain\Products\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
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
                'images' => [
                    'data' => $this->resource->getImages()
                ]
            ],
            'links' => [
                'self' => route('api.products.show', $this->resource)
            ]
        ];
    }
}
