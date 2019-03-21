<?php

namespace MacsiDigital\Xero;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Macsidigital\XeroLaravel\Skeleton\SkeletonClass
 */
class XeroFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'xero';
    }
}
