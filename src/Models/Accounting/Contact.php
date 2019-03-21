<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Contact extends Model
{
	const ENDPOINT = 'Contacts';
    const NODE_NAME = 'Contact';

    protected $attributes = [
    	'ContactID' => '',
        'ContactNumber' => '',
        'AccountNumber' => '',
        'ContactStatus' => '',
        'Name' => '',
        'FirstName' => '', 
        'LastName' => '',
        'EmailAddress' => '',
        'SkypeUserName' => '',
        'ContactPersons' => '',
        'BankAccountDetails' => '',
        'TaxNumber' => '',
        'AccountsReceivableTaxType' => '',
        'AccountsPayableTaxType' => '',
        'Addresses' => '',
        'Phones' => '',
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
        'HasAttachments' => ''
    ];
}
