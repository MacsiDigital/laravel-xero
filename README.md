# Xero Laravel 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/macsidigital/xero-laravel.svg?style=flat-square)](https://packagist.org/packages/macsidigital/xero-laravel)
[![Build Status](https://img.shields.io/travis/macsidigital/xero-laravel/master.svg?style=flat-square)](https://travis-ci.org/macsidigital/xero-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/macsidigital/xero-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/macsidigital/xero-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/macsidigital/xero-laravel.svg?style=flat-square)](https://packagist.org/packages/macsidigital/xero-laravel)

A little Laravel package to communicate with Xero.

## Installation

You can install the package via composer:

```bash
composer require macsidigital/xero-laravel
```

## Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Xero\XeroServiceProvider"
```

This will create a xero/config.php within your config directory. Check the Xero documentation for the relevant values in the config.php file.
Ensure that the location of the RSA keys matches.

## Usage

Everything has been setup to be similar to Laravel syntax.

We also use a little bit of magic to work with Xero's model names.  In Xero there are a few differnet modules (Accounting, Payroll AU etc.), at the minute we only support a small part of the accounting area, but we have set naming so that additional modules can be added in future.

So to use the conacts in the Accounting modelue we would use the following syntax.

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$xero->AccountingContact->functionName();
```

## Find all

The function returns a Laravel Collection

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contacts = $xero->AccountingContact->all();
```

## Filtered

The function returns a Laravel Collection

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contacts = $xero->AccountingContact->where('Name', '==', 'Test Name')->get();
```

To only get a single item use the 'first' method

``` php
	$xero = new \MacsiDigital\Xero\Xero;
	$contact = $xero->AccountingContact->where('Name', '==', 'Test Name')->first();
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
	$contact = $xero->AccountingContact->where('name', '==', 'Test Name')->first();
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
    $response = $invoice->save();
```

## Resources

At present we have the following resources

Account
Contacts
Invoices
Payments
PrePayments
OverPayments
CreditNotes

We plan to add more resources in the future but setting up additional models is straight forward, below is the invoice model setup.  If you create any models, then create a pull request and we will add into main repo.

``` php
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
```

### Testing

At present there is no PHP Unit Testing, but we plan to add it in the future, one handy thing to note is on the save function we return a response which will be 'false' if there was a problem, so if you need to trouble shoot then catch this and query it like so

``` php
	$response = $contact->save();
    if($response === false){
        dd($response->getContents());
    }
```

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