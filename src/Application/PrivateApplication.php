<?php

namespace MacsiDigital\Xero\Application;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class PrivateApplication extends Base
{

	protected $client;

	protected $options = [
        'headers' => [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ]
    ];

 	public function __construct(){
		$middleware = new Oauth1([
		   'consumer_key' => config('xero.oauth.consumer_key'),
		   'token' => config('xero.oauth.consumer_key'),
		   'private_key_file' => storage_path(config('xero.oauth.rsa_private_key')),
		   'private_key_passphrase' => config('xero.oauth.rsa_private_key_passphrase'),
		   'signature_method' => Oauth1::SIGNATURE_METHOD_RSA,
		]);

		$stack = HandlerStack::create();
		$stack->push($middleware);

		$options = [
		    'base_uri' => 'https://api.xero.com/api.xro/2.0/',
		    'handler' => $stack,
		    'auth' => 'oauth'
		];

		$this->client = new Client($options);
    }

}