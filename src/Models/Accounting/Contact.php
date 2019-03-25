<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Contact extends Model
{
    const ENDPOINT = 'Contacts';
    const NODE_NAME = 'Contact';
    const KEY_FIELD = 'ContactID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'ContactID' => '',
        'ContactNumber' => '',
        'AccountNumber' => '',
        'ContactStatus' => 'ACTIVE',
        'Name' => '',
        'FirstName' => '',
        'LastName' => '',
        'EmailAddress' => '',
        'SkypeUserName' => '',
        'ContactPersons' => [],
        'BankAccountDetails' => '',
        'TaxNumber' => '',
        'AccountsReceivableTaxType' => '',
        'AccountsPayableTaxType' => '',
        'Addresses' => [],
        'Phones' => [],
        'IsSupplier' => '',
        'IsCustomer' => '',
        'DefaultCurrency' => '',
        'XeroNetworkKey' => '',
        'SalesDefaultAccountCode' => '',
        'PurchasesDefaultAccountCode' => '',
        'SalesTrackingCategories' => '',
        'PurchasesTrackingCategories' => '',
        'TrackingCategoryName' => '',
        'TrackingCategoryOption' => '',
        'PaymentTerms' => '',
        'UpdatedDateUTC' => '',
        'ContactGroups' => '',
        'Website' => '',
        'BrandingTheme' => '',
        'BatchPayments' => '',
        'Discount' => '',
        'Balances' => '',
        'HasAttachments' => '',
    ];

    protected $relationships = [
        'Addresses' => '\MacsiDigital\Xero\Models\Accounting\Address',
        'Phones' => '\MacsiDigital\Xero\Models\Accounting\Phone',
        'ContactPersons' => '\MacsiDigital\Xero\Models\Accounting\ContactPerson',
    ];

    public function addAddress($item)
    {
        $this->attributes['Addresses'][] = $item;
    }

    public function addPhone($item)
    {
        $this->attributes['Phones'][] = $item;
    }
}
