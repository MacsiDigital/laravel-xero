<?php

namespace MacsiDigital\Xero\Accounting;

use MacsiDigital\Xero\Support\Model;

class Overpayment extends Model
{
    const ENDPOINT = 'OverPayments';
    const NODE_NAME = 'OverPayment';
    const KEY_FIELD = 'OverPaymentID';

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
        'OverpaymentID' => '',
        'CurrencyRate' => '',
        'RemainingCredit' => '',
        'Allocations' => '',
        'Paymetns' => '',
        'HasAttachments' => '',
    ];

    protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\AccountingContact',
        'LineItems' => '\MacsiDigital\Xero\AccountingLineItem',
        'Payments' => '\MacsiDigital\Xero\AccountingPayment',
    ];
}
