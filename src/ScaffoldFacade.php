<?php

namespace Bytedigital123\pixel-boilerplate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bytedigital123\pixel-boilerplate\Skeleton\SkeletonClass
 */
class ScaffoldFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'scaffold';
    }
}
