<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingInvoice extends Model
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
        'CreditNotes' => [],
    ];

    protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\AccountingContact',
        'LineItems' => '\MacsiDigital\Xero\AccountingLineItem',
        'Payments' => '\MacsiDigital\Xero\AccountingPayment',
        'Prepayments' => '\MacsiDigital\Xero\AccountingPrepayment',
        'Overpayments' => '\MacsiDigital\Xero\AccountingOverpayment',
    ];

    public function addLineItem($item)
    {
        $this->attributes['LineItems'][] = $item;
    }
}
