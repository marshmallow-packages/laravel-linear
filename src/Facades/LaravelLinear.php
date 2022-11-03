<?php

namespace LaravelLinear\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelLinear\LaravelLinear
 */
class LaravelLinear extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelLinear\LaravelLinear::class;
    }
}
