# Laravel package for Xero Accounting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/macsidigital/laravel-xero.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-xero)
[![Build Status](https://img.shields.io/travis/macsidigital/laravel-xero/master.svg?style=flat-square)](https://travis-ci.org/MacsiDigital/laravel-xero)
[![StyleCI](https://github.styleci.io/repos/193588958/shield?branch=master)](https://github.styleci.io/repos/193588958)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MacsiDigital/laravel-xero/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MacsiDigital/laravel-xero/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/macsidigital/laravel-xero.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-xero)

Laravel Xero API.

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-xero
```

### Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Xero\Providers\XeroServiceProvider"
```

This will create a xero.php within your config directory, Xero uses OAuth2 your config will look like this, you need to add XERO_CLIENT_ID and XERO_CLIENT_SECRET into your .env file.  Alse set the authorisedRedirect and failedRedirect settings, to set teh return URL after authenticated.

```php
return [
	'baseUrl' => 'https://api.xero.com/api.xro/2.0',
	'identityUrl' => 'https://api.xero.com/',
    'oauth2' => [
		'clientId' => env('XERO_CLIENT_ID'),
		'clientSecret' => env('XERO_CLIENT_SECRET'),
		'urlAuthorize' => 'https://login.xero.com/identity/connect/authorize',
    	'urlAccessToken' => 'https://identity.xero.com/connect/token',
    	'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
	],
	'options' => [
		'scope' => ['openid email profile offline_access accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
	],
	'tokenProcessor' => '\MacsiDigital\Xero\Support\AuthorisationProcessor',
	'tokenModel' => '\MacsiDigital\Xero\Support\Token\File',
	'authorisedRedirect' => '/success',
	'failedRedirect' => '/failed',
];
```

That should be it.  To authenticate you need to point to 

```php
route('oauth2.authorise', ['integration' => 'xero']);
```

## Usage

Our wish for our API's is to get as close to Laravel syntax and handling as possible.  So anything you do in Laravel you should be able to do in the API.  yOur first call will be to the Xero Model and from there you request the element you want, so for example for retreive the first AccountContact's name

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$xero->AccountingContact->first()->name;
```

## Find all

The find all function returns a Laravel Collection so you can use all the Laravel Collection magic

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contacts = $xero->AccountingContact->all();
```

## Filtered

The filtered find function returns a Laravel Collection so you can use all the Laravel Collection magic

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contacts = $xero->AccountingContact->where('Name', 'Test Name')->get();
```

To only get a single item use the 'first' method

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contact = $xero->AccountingContact->where('Name', 'Test Name')->first();
```

## Find by ID

Just like Laravel we can use the 'find' method to return a single matched result on the ID

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contact = $xero->AccountingContact->find('ID_String');
```

## Creating Items

We can create and update records using the save function, below is the full save script for a creation. Please note the functions for adding multi array items, like addresses.

``` php
	$contact = $xero->AccountingContact->make([
        'Name' => 'Test Name',
        'FirstName' => 'First Name',
        'LastName' => 'Last Name',
        'EmailAddress' => 'test@test.com',
        'IsCustomer' => true,
    ]);
    $contact->addAddress($xero->AccountingAddress->make([
        'AddressType' => 'POBOX',
        'AddressLine1' => 'Test1',
        'AddressLine2' => 'Test2',
        'AddressLine3' => 'Test3',
        'City' => 'City',
        'PostalCode' => 'Test Code',
        'Country' => 'Test Country',
    ]));
    $contact->save();
```

## Example

Here is an example usage case for querying for a contact, creating if not found and then creating an invoice

``` php
	$contact = $xero->AccountingContact->where('name', 'Test Name')->first();
    if($contact == null){
        $contact = $xero->AccountingContact->make([
	        'Name' => 'Test Name',
	        'FirstName' => 'First Name',
	        'LastName' => 'Last Name',
	        'EmailAddress' => 'test@test.com',
	        'IsCustomer' => true,
	    ]);
	    $contact->addAddress($xero->AccountingAddress->make([
	        'AddressType' => 'POBOX',
	        'AddressLine1' => 'Test1',
	        'AddressLine2' => 'Test2',
	        'AddressLine3' => 'Test3',
	        'City' => 'City',
	        'PostalCode' => 'Test Code',
	        'Country' => 'Test Country',
	    ]));
	    $contact->save();
    }
    $invoice = $xero->AccountingInvoice->make([
        'Contact' => $contact,
    ]);
    $invoice->addLineItem($xero->AccountingLineItem->make([
        'Description' => 'Test Description',
        'Quantity' => '1',
        'UnitAmount' => '1234.56',
        'AccountCode' => '200'
    ]));
    $invoice->save();
```

## Resources

At present we have the following resources

* Account
* Contacts
* Invoices
* Payments
* PrePayments
* OverPayments
* CreditNotes

We plan to add more resources in the future but setting up additional models is straight forward, below is the invoice model setup.  If you create any models, then create a pull request and we will add into main repo.

``` php
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
```

### Testing

At present there is no PHP Unit Testing, but we plan to add it in the future.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email colin@macsi.co.uk instead of using the issue tracker.

## Credits

- [Colin Hall](https://github.com/macsidigital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
