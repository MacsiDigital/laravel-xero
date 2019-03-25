<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Invoice extends Model
{
    const ENDPOINT = 'Invoices';
    const NODE_NAME = 'Invoice';
    const KEY_FIELD = 'InvoiceID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
    	'Type' => 'ACCREC',
        'Contact' => '',
        'LineItems' => [],
        'Date' => '',
        'DueDate' => '',
        'LineAmountTypes' => '',
        'InvoiceNumber' => '',
        'Reference' => '',
        'BrandingThemeID' => '',
        'Url' => '',
        'CurrencyCode' => '',
        'CurrencyRate' => '',
        'Status' => '',
        'SentToContact' => '',
        'ExpectedPaymentDate' => '',
        'PlannedPaymentDate' => '',
        'SubTotal' => '',
        'TotalTax' => '',
        'Total' => '',
        'TotalDiscount' => '',
        'InvoiceID' => '',
        'HasAttachments' => '',
        'Payments' => [],
        'Prepayments' => [],
        'Overpayments' => [],
        'AmountDue' => '',
        'AmountPaid' => '',
        'FullyPaidOnDate' => '',
        'AmountCredited' => '',
        'UpdatedDateUTC' => '',
        'CreditNotes' => []
    ];

    protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\Models\Accounting\Contact',
        'LineItems' => '\MacsiDigital\Xero\Models\Accounting\LineItem',
        'Payments' => '\MacsiDigital\Xero\Models\Accounting\Payment',
        'Prepayments' => '\MacsiDigital\Xero\Models\Accounting\Prepayment',
        'Overpayments' => '\MacsiDigital\Xero\Models\Accounting\Overpayment',
    ];

    public function addLineItem($item) 
    {
        $this->attributes['LineItems'][] = $item;
    }
}
