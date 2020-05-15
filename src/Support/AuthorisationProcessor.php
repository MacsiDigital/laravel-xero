<?php

namespace MacsiDigital\Xero\Support;

use MacsiDigital\Xero\Facades\Identity;
use MacsiDigital\Xero\Identity\Connection;
use MacsiDigital\Xero\Exceptions\CantRetreiveTenantException;

class AuthorisationProcessor
{
	public function __construct($accessToken, $integration)
    {
    	$config = config($integration);
    
    	$token = $config['tokenModel'];

    	$token = (new $token($integration))->set([
        	'accessToken' => $accessToken->getToken(),
        	'refreshToken' => $accessToken->getRefreshToken(),
        	'expires' => $accessToken->getExpires(),
        	'idToken' => $accessToken->getValues()['id_token']
        ])->save();

    	$connection = Identity::connection()->raw()->get();
    	
    	if($connection != []){
    		$tenantId = $connection->json()[0]['tenantId'];
	        
	        $token->set(['tenantId' => $tenantId])->save();

	        return $token;
    	} else{
    		throw new CantRetreiveTenantException;
    	}
       
    }

}