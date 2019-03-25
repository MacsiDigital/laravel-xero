<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Allocation extends Model
{
    const ENDPOINT = 'Allocations';
    const NODE_NAME = 'Allocation';
    const KEY_FIELD = 'AllocationID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'Invoice' => '',
        'AppliedAmount' => '',
        'Date' => '',
    ];

    protected $relationships = [
        'Invoice' => '\MacsiDigital\Xero\Models\Accounting\Invoice',
    ];
}
