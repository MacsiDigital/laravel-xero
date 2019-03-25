<?php

return [
    'oauth' => [
        'callback'    		=> config('app.url'),
        'consumer_key'      => env('XERO_KEY'),
        'consumer_secret'   => env('XERO_SECRET'),
        'rsa_private_key'   => env('XERO_PRIVATE_KEY'), //'file:///storage/certs/privatekey.pem'
        'rsa_private_key_passphrase'   => env('XERO_PRIVATE_KEY_PASSPHRASE'),
    ],
];
