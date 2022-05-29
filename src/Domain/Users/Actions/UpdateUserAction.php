<?php

namespace Domain\Users\Actions;

use Domain\Users\DTO\UserData;
use Domain\Users\Models\User;
use Support\Services\ClearNullOnUpdatesService;

class UpdateUserAction
{
    public function __invoke(UserData $data, User $user): User
    {
        $data = ClearNullOnUpdatesService::execute($data);
        $user->fill($data);

        if (auth()->user()->hasRole('admin') && isset($data['role'])){
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }
}
