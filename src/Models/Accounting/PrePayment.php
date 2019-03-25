<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class PrePayment extends Model
{
    const ENDPOINT = 'PrePayments';
    const NODE_NAME = 'PrePayment';
    const KEY_FIELD = 'PrePaymentID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'Reference' => '',
        'Type' => '',
        'Contact' => '',
        'Date' => '',
        'Status' => '',
        'LineAmountTypes' => '',
        'LineItems' => '',
        'SubTotal' => '',
        'TotalTax' => '',
        'Total' => '',
        'UpdatedDateUTC' => '',
        'CurrencyCode' => '',
        'FullyPaidOnDate' => '',
        'PrepaymentID' => '',
        'CurrencyRate' => '',
        'RemainingCredit' => '',
        'Allocations' => '',
        'HasAttachments' => '',
    ];

    protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\Models\Accounting\Contact',
        'LineItems' => '\MacsiDigital\Xero\Models\Accounting\LineItem',
        'Allocation' => '\MacsiDigital\Xero\Models\Accounting\Allocation',
    ];
}
