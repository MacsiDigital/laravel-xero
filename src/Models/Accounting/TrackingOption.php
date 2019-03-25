<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class TrackingOption extends Model
{
    const ENDPOINT = 'TrackingOptions';
    const NODE_NAME = 'TrackingOption';
    const KEY_FIELD = 'TrackingOptionID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'TrackingOptionID' => '',
        'Name' => '',
        'Status' => '',
    ];
}
