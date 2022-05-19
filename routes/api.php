<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Start Oxygen API routes
Route::group([
	'prefix' => 'v1',
	'middleware' => ['auth.api'],
	'namespace' => '\App\Http\Controllers\API\V1'
], function() {

	if (config('features.api_active')) {
		Route::post('/register', 'Auth\AuthController@register');
		Route::post('/login',    'Auth\AuthController@login');
		Route::post('/password/email', 'Auth\ForgotPasswordController@checkRequest');

		// guest (all-users) API routes
		Route::get('/guests', 'GuestController@index');
        Route::get('/faqs', 'FAQsController@index');

		// logged-in users
		Route::group(['middleware' => ['auth.api.logged-in']], function() {
			Route::get('/logout', 'Auth\AuthController@logout');
			Route::get ('/profile', 'Auth\ProfileController@index');
			Route::put ('/profile', 'Auth\ProfileController@update');
			Route::post('/avatar', 'Auth\ProfileController@updateAvatar');
			Route::post('/password/edit', 'Auth\ResetPasswordController@updatePassword');

			Route::post('/claim-order', 'OrdersController@claimOrder');

			// games
			Route::get('/games', 'GamesController@index');
            Route::post('/games', 'GamesController@store');

            // teams
			// TODO: add team addition and players
			// TODO: add invite guests

			// leaderboard
			Route::get('/leaderboard', 'LeaderboardController@index');

			// TODO: add other logged-in user routes

		});
	}
});
// End Oxygen API routes
