<?php

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
	'authorisedRedirect' => '',
	'failedRedirect' => '',
];
