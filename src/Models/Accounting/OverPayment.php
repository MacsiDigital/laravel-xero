<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class OverPayment extends Model
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
        'HasAttachments' => ''
	];

	protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\Models\Accounting\Contact',
        'LineItems' => '\MacsiDigital\Xero\Models\Accounting\LineItem',
        'Payments' => '\MacsiDigital\Xero\Models\Accounting\Payment',
    ];

}