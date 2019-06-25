<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingContactPerson extends Model
{
    const ENDPOINT = 'ContactPerson';
    const NODE_NAME = 'ContactPerson';
    const KEY_FIELD = 'ContactPersonID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'FirstName' => '',
        'LastName' => '',
        'EmailAddress' => '',
        'IncludeInEmails' => '',
    ];
}
