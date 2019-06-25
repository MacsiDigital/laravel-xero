<?php

namespace MacsiDigital\Xero\Interfaces;

use MacsiDigital\Xero\Support\Request;

class PrivateApplication extends Base
{
    protected $request;

    public function __construct()
    {
        $this->request = (new Request)->bootPrivateApplication();
    }
}
