<?php

namespace MacsiDigital\Xero\Accounting;

use MacsiDigital\Xero\Support\Model;

class Payment extends Model
{
    const ENDPOINT = 'Payments';
    const NODE_NAME = 'Payment';
    const KEY_FIELD = 'PaymentID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'Invoice' => '',
        'CreditNote' => '',
        'Prepayment' => '',
        'Overpayment' => '',
        'Account' => '',
        'Date' => '',
        'CurrencyRate' => '',
        'Amount' => '',
        'Reference' => '',
        'IsReconciled' => '',
        'Status' => '',
        'PaymentType' => '',
        'UpdatedDateUTC' => '',
        'PaymentID' => '',
    ];

    protected $relationships = [
        'CreditNote' => '\MacsiDigital\Xero\Accounting\CreditNote',
        'Payments' => '\MacsiDigital\Xero\AccountingPayment',
        'Prepayments' => '\MacsiDigital\Xero\AccountingPrepayment',
        'Overpayments' => '\MacsiDigital\Xero\AccountingOverpayment',
        'Invoice' => '\MacsiDigital\Xero\AccountingInvoice',
        'Account' => '\MacsiDigital\Xero\AccountingAccount',
    ];
}
