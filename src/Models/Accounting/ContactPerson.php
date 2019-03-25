<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class ContactPerson extends Model
{
	const ENDPOINT = 'ContactPerson';
    const NODE_NAME = 'ContactPerson';
    const KEY_FIELD = 'ContactPersonID';

    protected $methods = ['get', 'post', 'put'];

	protected $attributes = [
		"FirstName" => '',
        "LastName" => '',
        "EmailAddress" => '',
        "IncludeInEmails" => ''
	];

}