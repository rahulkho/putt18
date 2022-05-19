<?php


namespace App\Http\Controllers\Manage;

class PushNotificationsController extends \EMedia\OxygenPushNotifications\Http\Controllers\Manage\PushNotificationsController
{

	// Add any custom logic or override the functions

	protected function indexRouteName()
	{
		return 'manage.push-notifications.index';
	}

	protected function indexViewName()
	{
		return 'oxygen-push-notifications::manage.index';
	}

}
