<?php

namespace MacsiDigital\Xero\Application;

use MacsiDigital\Xero\Support\Request;

class PrivateApplication extends Base
{

	protected $request;

 	public function __construct()
 	{
        $this->request = (new Request)->bootPrivateApplication();
    }

}