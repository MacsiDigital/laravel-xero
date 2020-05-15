<?php

namespace MacsiDigital\Xero\Support;

use MacsiDigital\Xero\Facades\Client;
use MacsiDigital\API\Support\Entry as ApiEntry;

class Entry extends ApiEntry
{

    public function newRequest()
    {   
    	$config = config('xero');
    	$class = $config['tokenModel'];
    	$token = new $class('xero');
    	if($token->hasExpired()){
    		$token = $token->renewToken();
    	}
        return Client::baseUrl($config['baseUrl'])->withToken($token->accessToken())->withHeaders(['xero-tenant-id' => $token->tenantId()]);
    }

}
