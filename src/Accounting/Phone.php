<?php

namespace MacsiDigital\Xero\Accounting;

use MacsiDigital\Xero\Support\Model;

class Phone extends Model
{
    const ENDPOINT = 'Phones';
    const NODE_NAME = 'Phone';
    const KEY_FIELD = 'PhoneID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'PhoneType' => '',
        'PhoneNumber' => '',
        'PhoneAreaCode' => '',
        'PhoneCountryCode' => '',
    ];
}
