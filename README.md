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
Ensure that the location of the RSA keys matches the Xero required format (file://absolutepath)

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
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