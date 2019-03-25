<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class Address extends Model
{
	const ENDPOINT = 'Addresses';
    const NODE_NAME = 'Address';
    const KEY_FIELD = 'AddressID';

    protected $methods = [];

	protected $attributes = [
		'AddressType' => 'POBOX',
		'AddressLine1' => '',
		'AddressLine2' => '',
		'AddressLine3' => '',
		'AddressLine3' => '',
		'City' => '',
		'Region' => '',
		'PostalCode' => '',
		'Country' => '',
		'AttentionTo' => ''
	];

}