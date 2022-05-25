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
                ]
            ],
            'links' => [
                'self' => 'https://foo/bar', /*route('api.v1.' . $this->resource->getTable() . '.show', $this->resource)*/
            ]
        ];
    }
}
