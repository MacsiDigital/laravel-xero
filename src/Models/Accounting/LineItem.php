<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class LineItem extends Model
{
    const ENDPOINT = 'LineItems';
    const NODE_NAME = 'LineItem';
    const KEY_FIELD = 'LineItemID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'Description' => '',
        'Quantity' => '',
        'UnitAmount' => '',
        'ItemCode' => '',
        'AccountCode' => '',
        'LineItemID' => '',
        'TaxType' => '',
        'TaxAmount' => '',
        'LineAmount' => '',
        'Tracking' => '',
        'DiscountRate' => '',
    ];

    protected $relationships = [
        'Tracking' => '\MacsiDigital\Xero\Models\Accounting\TrackingCategory',
    ];
}
