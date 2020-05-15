<?php

namespace MacsiDigital\Xero\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Macsidigital\XeroLaravel\Skeleton\SkeletonClass
 */
class Identity extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'xero.identity';
    }
}
