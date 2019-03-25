<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Account extends Model
{
    const ENDPOINT = 'Accounts';
    const NODE_NAME = 'Account';
    const KEY_FIELD = 'AccountID';

    protected $methods = ['get', 'post', 'put', 'delete'];

    protected $attributes = [
        'Code' => '',
        'Name' => '',
        'Type' => '',
        'BankAccountNumber' => '',
        'Status' => '',
        'Description' => '',
        'BankAccountType' => '',
        'CurrencyCode' => '',
        'TaxType' => '',
        'EnablePaymentsToAccount' => '',
        'ShowInExpenseClaims' => '',
        'AccountID' => '',
        'Class' => '',
        'SystemAccount' => '',
        'ReportingCode' => '',
        'ReportingCodeName' => '',
        'HasAttachments' => '',
        'UpdatedDateUTC' => '',
    ];
}
