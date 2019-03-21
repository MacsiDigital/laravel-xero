<?php

namespace MacsiDigital\Xero\Application;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Base
{

	protected $client;

	protected $options = [
        'headers' => [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ]
    ];

    public function getClient() 
    {
    	return $this;
    }

    public function get($end_point, $variables=[], $options=[])
    {
    	$options = array_merge($this->options, $options);
    	return $this->parse($this->client->get($end_point, $options));
    }

    public function post()
    {
    	
    }

    public function put()
    {
    	
    }

    public function delete()
    {
    	
    }

    public function parse($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

}