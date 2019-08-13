<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingContact extends Model
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
        'Addresses' => '\MacsiDigital\Xero\AccountingAddress',
        'Phones' => '\MacsiDigital\Xero\AccountingPhone',
        'ContactPersons' => '\MacsiDigital\Xero\AccountingContactPerson',
    ];

    protected $queryAttributes = [
      'Name',
      'EmailAddress',
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
