<?php

namespace MacsiDigital\Xero;

use MacsiDigital\Xero\Support\Model;

class AccountingTrackingCategory extends Model
{
    const ENDPOINT = 'TrackingCategories';
    const NODE_NAME = 'TrackingCategory';
    const KEY_FIELD = 'TrackingCategoryID';

    protected $methods = ['get', 'post', 'put'];

    protected $attributes = [
        'TrackingCategoryID' => '',
        'Name' => '',
        'TrackingCategoryName' => '',
        'TrackingOptionName' => '',
        'Status' => '',
        'Options' => '',
        'Option' => '',
    ];

    protected $relationships = [
        'Options' => '\MacsiDigital\Xero\AccountingTrackingOption',
    ];
}
