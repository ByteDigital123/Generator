<?php

namespace Bytedigital123\Generator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bytedigital123\Generator\Skeleton\SkeletonClass
 */
class GeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Generator';
    }
}
