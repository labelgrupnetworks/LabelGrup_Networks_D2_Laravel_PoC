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
                'self' => route('products.index'),
            ],
            'meta' => [
                'products_count' => $this->collection->count()
            ]
        ];
    }
}
