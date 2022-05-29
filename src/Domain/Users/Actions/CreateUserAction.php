<?php

namespace Domain\Users\Actions;

use Domain\Users\DTO\UserData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function __invoke(UserData $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        if (auth()->user()?->hasRole('admin') && !is_null($data->role)){
            $user->syncRoles([$data->role]);
        }

        return $user;
    }
}
