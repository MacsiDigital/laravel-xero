<?php

namespace MacsiDigital\Xero\Models\Accounting;

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
        'Contact' => '\MacsiDigital\Xero\Models\Accounting\Contact',
        'LineItems' => '\MacsiDigital\Xero\Models\Accounting\LineItem',
        'Payments' => '\MacsiDigital\Xero\Models\Accounting\Payment',
        'Allocation' => '\MacsiDigital\Xero\Models\Accounting\Allocation',
    ];
}
