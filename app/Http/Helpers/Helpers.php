<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Redirect, Response;
use Illuminate\Support\Facades\Route;


class Helpers {

    // Check authority
    public static  function isAdmin()
    {
        $user = Auth::user();

        if($user->hasRole('Administrador') || $user->hasRole('Moderador'))
        {
           return true;
        }
    }
}
