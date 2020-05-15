<?php

namespace MacsiDigital\Xero\Identity;

use MacsiDigital\API\Support\Entry;
use MacsiDigital\Xero\Facades\Client;
use MacsiDigital\Xero\Identity\Connection;

class Api extends Entry
{
    protected $modelNamespace = 'MacsiDigital\Xero\Identity\\';

    public function newRequest()
    {   
    	$config = config('xero');
    	$class = $config['tokenModel'];
    	$token = new $class('xero');
        return Client::baseUrl($config['identityUrl'])->withToken($token->accessToken());
    }

}
