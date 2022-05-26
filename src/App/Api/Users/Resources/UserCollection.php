<?php

namespace App\Api\Users\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Domain\Users\Models\User */
class UserCollection extends ResourceCollection
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
                'self' => route('users.index'),
            ],
            'meta' => [
                'users_count' => $this->collection->count()
            ]
        ];
    }
}
