<?php

/*
|--------------------------------------------------------------------------
| Enable or disable application features from this file
|--------------------------------------------------------------------------
|
| Instead of copying and pasting code blocks, add all the standard features
| and enable or disable the features as they're required by the clients.
|
| The features listed here must be available across sandbox and live environments.
| If you need to have custom features across sandbox and live environments, move
| them to an .env file parameter, and refer to it on this page.
|
*/

return [

	/*
	|--------------------------------------------------------------------------
	| AUTHENTICATION FEATURES
	|--------------------------------------------------------------------------
	*/

	'auth' => [
		// allow any user to register
		'public-users-can-register' => env('REGISTRATIONS_ENABLED', false),

		// force email verification after registration
		'email-verification-required' => false,

	],

	/*
	|--------------------------------------------------------------------------
	| SECURITY FEATURES
	|--------------------------------------------------------------------------
	*/

	'security' => [
		// to reduce spam contacts, enable recaptcha on .env file
		'recaptcha_enabled' => env('RECAPTCHA_ENABLED', false),
	],

	'api_active' => env('API_ACTIVE', false),

];
