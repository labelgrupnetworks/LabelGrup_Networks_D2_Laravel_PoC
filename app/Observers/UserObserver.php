<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;

class UserObserver
{
    public function deleted(User $user): void
    {
        Product::where('id_user', '=', $user->id_user)->delete();
    }
}
