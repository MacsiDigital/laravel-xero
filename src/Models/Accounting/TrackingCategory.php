<?php

namespace MacsiDigital\Xero\Models\Accounting;

use MacsiDigital\Xero\Support\Model;

class TrackingCategory extends Model
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
        'Option' => ''
    ];

    protected $relationships = [
        'Options' => '\MacsiDigital\Xero\Models\Accounting\TrackingOption'
    ];

}
