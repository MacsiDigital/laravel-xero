<?php

namespace MacsiDigital\Xero\Accounting;

use MacsiDigital\Xero\Support\Model;

class CreditNote extends Model
{
    const ENDPOINT = 'CreditNotes';
    const NODE_NAME = 'CreditNote';
    const KEY_FIELD = 'CreditNoteID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'Type' => '',
        'Contact' => '',
        'Date' => '',
        'Status' => '',
        'LineAmountTypes' => '',
        'LineItems' => '',
        'Payments' => '',
        'SubTotal' => '',
        'TotalTax' => '',
        'Total' => '',
        'UpdatedDateUTC' => '',
        'CurrencyCode' => '',
        'FullyPaidOnDate' => '',
        'CreditNoteID' => '',
        'CreditNoteNumber' => '',
        'Reference' => '',
        'SentToContact' => '',
        'CurrencyRate' => '',
        'RemainingCredit' => '',
        'Allocations' => '',
        'BrandingThemeID' => '',
        'HasAttachments' => '',
    ];

    protected $relationships = [
        'Contact' => '\MacsiDigital\Xero\AccountingContact',
        'LineItems' => '\MacsiDigital\Xero\AccountingLineItem',
        'Payments' => '\MacsiDigital\Xero\AccountingPayment',
        'Allocation' => '\MacsiDigital\Xero\AccountingAllocation',
    ];
}
