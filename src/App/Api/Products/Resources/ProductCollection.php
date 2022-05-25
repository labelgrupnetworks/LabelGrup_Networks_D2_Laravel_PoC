<?php

namespace App\Api\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Domain\Products\Models\Product */
class ProductCollection extends ResourceCollection
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
