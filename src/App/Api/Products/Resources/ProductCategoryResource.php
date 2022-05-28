<?php

namespace App\Api\Products\Resources;

use Domain\Categories\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Category */
class ProductCategoryResource extends JsonResource
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
            'attributes' => $this->resource->fieldsForRelations(),
            'links' => [
                'self' => route('api.categories.show', $this->resource)
            ]
        ];
    }
}
