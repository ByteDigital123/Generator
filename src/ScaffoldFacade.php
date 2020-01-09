<?php

namespace Bytedigital123\Scaffold;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bytedigital123\Scaffold\Skeleton\SkeletonClass
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
