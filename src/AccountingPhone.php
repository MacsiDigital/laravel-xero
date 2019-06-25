<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingPhone extends Model
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
