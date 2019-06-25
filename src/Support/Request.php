<?php

namespace MacsiDigital\Xero\Support;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Request
{
    protected $client;
    protected $headers;

    public function bootPrivateApplication()
    {
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
            'auth' => 'oauth',
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ],
        ];

        $this->client = new Client($options);

        return $this;
    }

    public function get($end_point)
    {
        try {
            return $this->client->request('GET', $end_point);
        } catch (Exception $e) {
            return $e->getResponse();
        }
    }

    public function post($end_point, $fields)
    {
        try {
            return $this->client->post($end_point, [
                'body' => $this->prepareFields($fields),
            ]);
        } catch (Exception $e) {
            return $e->getResponse();
        }
    }

    public function put($end_point, $fields)
    {
        try {
            return $this->client->put($end_point, [
                'body' => $this->prepareFields($fields),
            ]);
        } catch (MacsiDigital\Exception $e) {
            return $e->getResponse();
        }
    }

    public function delete($end_point)
    {
        return $this->client->delete($end_point, [
            'headers' => $this->headers,
        ]);
    }

    private function prepareFields($fields)
    {
        $return = [];
        foreach ($fields as $key => $value) {
            if ($value != [] && $value != '') {
                if (is_array($value)) {
                    foreach ($value as $sub_key => $object) {
                        if (is_object($object)) {
                            if (is_array($fields[$key][$sub_key])) {
                                $return[$key][$sub_key][] = $object->getAttributes();
                            } else {
                                $return[$key][$sub_key] = $object->getAttributes();
                            }
                        } else {
                            if (is_array($fields[$key][$sub_key])) {
                                $return[$key][$sub_key][] = $object;
                            } else {
                                $return[$key][$sub_key] = $object;
                            }
                        }
                    }
                } else {
                    if (is_object($value)) {
                        if (is_array($fields[$key])) {
                            $return[$key][] = $value->getAttributes();
                        } else {
                            $return[$key] = $value->getAttributes();
                        }
                    } else {
                        if (is_array($fields[$key])) {
                            $return[$key][] = $value;
                        } else {
                            $return[$key] = $value;
                        }
                    }
                }
            }
        }

        return json_encode($return);
    }
}
