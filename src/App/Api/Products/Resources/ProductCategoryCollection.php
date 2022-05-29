<?php

namespace App\Api\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Domain\Categories\Models\Category */
class ProductCategoryCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->collection);
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
