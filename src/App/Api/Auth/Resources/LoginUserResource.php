<?php

namespace App\Api\Auth\Resources;

use Domain\Users\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class LoginUserResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'type' => $this->resource->getTable(),
            'id' => $this->resource->getRouteKey(),
            'attributes' => $this->resource->fields(),
            'token' => [
                'token_type' => 'Bearer',
                'token_value' => $this->resource->createAuthToken(),
            ],
            'links' => [
                'self' => route('api.users.show', $this->resource)
            ]
        ];
    }
}
