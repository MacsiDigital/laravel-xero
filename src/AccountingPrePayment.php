<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingPrepayment extends Model
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
        'Contact' => '\MacsiDigital\Xero\AccountingContact',
        'LineItems' => '\MacsiDigital\Xero\AccountingLineItem',
        'Allocation' => '\MacsiDigital\Xero\AccountingAllocation',
    ];
}
