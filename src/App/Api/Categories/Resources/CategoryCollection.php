<?php

namespace App\Api\Categories\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Domain\Categories\Models\Category */
class CategoryCollection extends ResourceCollection
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
                'self' => route('api.categories.index'),
            ],
            'meta' => [
                'categories_count' => $this->collection->count()
            ]
        ];
    }
}
