<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Start Oxygen routes

// If there's a DEV_BROWSERSYNC_URL given, use it for the URLs
// this will help to generate consistent URLs with BrowserSync
// Don't use this on a production environment
// Don't uncomment unless you understand what this does
// if (app()->environment('local')) {
//    $domainRoot = env('DEV_BROWSERSYNC_URL', '');
//    if ($domainRoot !== '') \Illuminate\Support\Facades\URL::forceRootUrl($domainRoot);
//}

// Home
Route::get('/', function () {
	return view('oxygen::pages.welcome', ['pageTitle' => 'The Awesomeness Starts Here...']);
})->name('home');

// TODO: Add Custom Pages Here...

// Filler Pages...
Route::get('/privacy-policy', 	'PagesController@privacyPolicy')->name('pages.privacy-policy');
Route::get('/terms-conditions', 'PagesController@termsConditions')->name('pages.terms-conditions');
Route::get('/faqs', 			'PagesController@faqs')->name('pages.faqs');

// Contact Us...
Route::get( '/contact-us', 'PagesController@contactUs')->name('contact-us');
Route::post('/contact-us', 'PagesController@postContactUs');

// Authentication Routes...
Route::get ('login',	'Auth\LoginController@showLoginForm')->name('login');
Route::post('login',	'Auth\LoginController@login');
Route::get ('logout',   'Auth\LoginController@logout')->name('logout');
Route::post('logout',   'Auth\LoginController@logout');

// Registration Routes...
if (has_feature('auth.public-users-can-register')) {
	Route::get( 'register', 'Auth\RegisterController@showRegistrationForm')->name('register');
}
// The post registration route needs to be open for regular and invitations
Route::post('register', 'Auth\RegisterController@register')->name('register.store');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
if (has_feature('auth.email-verification-required')) {
	Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
	Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
	Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
}

// Register by Invitation...
Route::get('invitations/join/{code}', [
	'as'	=> 'invitations.join',
	'uses'	=> 'Auth\InvitationsController@showJoin'
]);

// Route for File Access
Route::group(['middleware' => 'web'], function () {
	Route::get('files/{uuid}/{fileName?}', 'Manage\ManageFilesController@publicView')->name('files.show');
});

// Authenticated Users...
Route::group(['middleware' => ['auth', 'auth.acl:roles[super-admin|admin]']], function()
{
	// Dashboard
	Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');


	Route::group(['prefix' => 'manage', 'as' => 'manage.'], function()
    {
        // Manage Files
        Route::get('files/view/{uuid}', 'Manage\ManageFilesController@show')->name('files.show');
        Route::get('files/download/{uuid}', 'Manage\ManageFilesController@download')->name('files.download');
        Route::resource('files', 'Manage\ManageFilesController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        // Manage Documentation
        Route::get('/docs/api', 'Manage\ManageDocumentationController@index')->name('documentation.index');
    });


	// User's Profile...
	Route::group(['prefix' => 'account'], function () {
		Route::get('/profile', 			'Auth\ProfileController@getProfile')->name('account.profile');
		Route::put('/profile', 			'Auth\ProfileController@updateProfile');
		Route::get('/email/edit', 		'Auth\ProfileController@getEmail')->name('account.email');
		Route::put('/email/edit', 		'Auth\ProfileController@updateEmail');
		Route::get('/password/edit',	'Auth\ResetPasswordController@editPassword')->name('account.password');
		Route::put('/password/edit',	'Auth\ResetPasswordController@updatePassword');
	});

	// Manage (Super Admin)...
	Route::group(['prefix' => 'account'], function ()
	{
		Route::get('/access', 'Auth\Admin\AccessController@index')->name('manage.access.index');

		// Groups (Roles)
		Route::group(['prefix' => 'groups'], function () {
			Route::get (  '/',			'Auth\Groups\GroupsController@index')->name('access.groups.index');
			Route::get (  '/new',		'Auth\Groups\GroupsController@create');
			Route::post(  '/',			'Auth\Groups\GroupsController@store');
			Route::post(  '/users',		'Auth\Groups\GroupsController@storeUsers');
			Route::get (  '{id}/users', 	'Auth\Groups\GroupsController@showUsers');
			Route::delete('/{roleId}/users/{userId}', 'Auth\Groups\GroupsController@destroyUser');
			Route::get (  '/{id}/edit',	'Auth\Groups\GroupsController@edit');
			Route::put (  '/{id}',		'Auth\Groups\GroupsController@update');
			Route::delete('/{id}',	'Auth\Groups\GroupsController@destroy');

			// Permissions for Role
            Route::group(['prefix' => '{roleId}/permissions'], function () {
                Route::get ('/', 'Auth\Abilities\AbilitiesController@editRoleAbilities');
                Route::put ('/', 'Auth\Abilities\AbilitiesController@updateRoleAbilities');
            });
		});

		// Abilities (Permissions)
		Route::group(['prefix' => 'permission-categories'], function () {
			Route::get ('/', 			'Auth\Abilities\AbilityCategoriesController@index')->name('access.abilities.index');
			/*
			Route::get ('/new', 		'Auth\Abilities\AbilityCategoriesController@create');
			Route::get ('/{id}/edit',	'Auth\Abilities\AbilityCategoriesController@edit');
			Route::post('/', 			'Auth\Abilities\AbilityCategoriesController@store');
			Route::put ('/{id}', 		'Auth\Abilities\AbilityCategoriesController@update');
			Route::delete('/{id}',		'Auth\Abilities\AbilityCategoriesController@destroy');
			*/
		});

		// Invitations
		Route::group(['prefix' => 'invitations'], function () {
			Route::get('/',			 'Auth\InvitationsController@index')->name('access.invitations.index');
			Route::get('/create',	 'Auth\InvitationsController@create')->name('access.invitations.create');
			Route::post('/',		 'Auth\InvitationsController@send');
			// Route::get('/{id}/edit', 'Auth\InvitationsController@edit');
			// Route::put('/{id}',		 'Auth\InvitationsController@update');
			Route::delete('/{id}',	 'Auth\InvitationsController@destroy');
		});

		// switch tenants (teams) - only for Multi-tenants
		// Route::get('teams/switch/{id}', 'Auth\TeamController@switchTeam');

		// Users
		Route::group([
        		'as' => 'manage.',
        		'namespace' => '\EMedia\Oxygen\Http\Controllers\Auth',
        	], function () {

			Route::resource('users', 'UsersController')->only('index', 'edit', 'update', 'destroy');
			Route::get('users/{user}/edit-password',  'UsersController@editPassword')->name('users.edit-password');
			Route::put('users/{user}/edit-password',  'UsersController@updatePassword');
			Route::put('users/{user}/update-disabled','UsersController@updateDisabled')->name('users.update-disabled');
        });
	});
});
// End Oxygen routes

// Start AppSettings Routes
Route::group(['prefix' => '/manage/settings', 'middleware' => ['auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::get('/', '\EMedia\AppSettings\Http\Controllers\SettingsController@index')->name('settings.index');
	Route::get('/new', '\EMedia\AppSettings\Http\Controllers\SettingsController@create')->name('settings.create');
	Route::get('/{id}/edit', '\EMedia\AppSettings\Http\Controllers\SettingsController@edit')->name('settings.edit');

	Route::post('/', '\EMedia\AppSettings\Http\Controllers\SettingsController@store')->name('settings.store');
	Route::put('/{id}', '\EMedia\AppSettings\Http\Controllers\SettingsController@update')->name('settings.update');
	Route::delete('/{id}', '\EMedia\AppSettings\Http\Controllers\SettingsController@destroy')->name('settings.destroy');
});
// End AppSettings Routes
// Start Devices Routes
Route::group(['prefix' => 'manage', 'middleware' => ['auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('devices', '\EMedia\Devices\Http\Controllers\Admin\DevicesController')
		 ->only('index', 'show', 'destroy');
});
// End Devices Routes

// Routes for Games
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('games', 'GamesController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});

// Routes for Teams
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('teams', 'TeamsController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});

// Routes for Players
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('players', 'PlayersController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});

// Routes for Faqs
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('faqs', 'FaqsController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});
// Start OxygenPushNotifications Routes
Route::group(['prefix' => 'manage', 'middleware' => ['auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('push-notifications', 'Manage\PushNotificationsController')
    		 ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

});
// End OxygenPushNotifications Routes


// Routes for Rankings
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('rankings', 'RankingsController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});


// Routes for Orders
Route::group(['prefix' => 'manage', 'middleware' => ['web', 'auth', 'auth.acl:roles[super-admin|admin]'], 'as' => 'manage.'], function()
{
	Route::resource('orders', 'OrdersController')->only('index', 'create', 'show', 'store', 'edit', 'update', 'destroy');
});
