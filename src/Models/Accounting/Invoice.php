<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Invoice extends Model
{
    const ENDPOINT = 'Invoices';
    const NODE_NAME = 'Invoice';

    protected $attributes = [];
}
