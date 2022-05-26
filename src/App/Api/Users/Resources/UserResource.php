<?php

namespace App\Api\Users\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Domain\Users\Models\User */
class UserResource extends JsonResource
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
            'links' => [
                'self' => route('users.show', $this->resource)
            ]
        ];
    }
}
