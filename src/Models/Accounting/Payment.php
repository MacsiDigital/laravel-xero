<?php

namespace MacsiDigital\Xero\Models\Accounting;

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
        'PaymentID' => ''
	];

	protected $relationships = [
        'CreditNote' => '\MacsiDigital\Xero\Models\Accounting\CreditNote',
        'Payments' => '\MacsiDigital\Xero\Models\Accounting\Payment',
        'Prepayments' => '\MacsiDigital\Xero\Models\Accounting\Prepayment',
        'Overpayments' => '\MacsiDigital\Xero\Models\Accounting\Overpayment',
        'Invoice' => '\MacsiDigital\Xero\Models\Accounting\Invoice',
        'Account' => '\MacsiDigital\Xero\Models\Accounting\Account'
    ];

}