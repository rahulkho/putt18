<?php


namespace App\Entities\PushNotifications;


class PushNotification extends \EMedia\OxygenPushNotifications\Entities\PushNotifications\PushNotification
{

	protected $visible = [
		'uuid',
		'title',
		'message',
		'badge_count',
		'data',
		'is_read',
		'sent_time_label',
	];

	protected $rules = [
		'title' => 'required|min:10|max:100',
		'message' => 'required|min:10|max:500',
		'topic' => 'required_without:device_id',
		'device_id' => 'required_without:topic',
	];

}
