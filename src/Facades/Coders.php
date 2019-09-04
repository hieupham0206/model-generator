<?php

namespace Cloudteam\ModelGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class Coders extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'coders';
    }
}
