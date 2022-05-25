<?php

namespace App\Providers;

use App\QueryBuilders\JsonApiBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use ReflectionException;

class JsonApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * @throws ReflectionException
     */
    public function boot()
    {
        Builder::mixin(new JsonApiBuilder());
    }
}
