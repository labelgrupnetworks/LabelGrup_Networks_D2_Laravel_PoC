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
                'self' => 'https://foo/bar/foobar',//route('api.v1.articles.index')
            ],
            'meta' => [
                'products_count' => $this->collection->count()
            ]
        ];
    }
}
