<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class AddTopicSubscriptionsToDevicesTable extends \Illuminate\Database\Migrations\Migration
{

	public function up()
	{
		Schema::table('devices', function(Blueprint $table) {
			$table->boolean('is_subscribed_to_all_devices_topic')->default(false);
			$table->boolean('is_subscribed_to_device_type_topic')->default(false);
		});
	}

	public function down()
	{
		Schema::table('devices', function(Blueprint $table) {
			$table->dropColumn('is_subscribed_to_all_devices_topic');
			$table->dropColumn('is_subscribed_to_device_type_topic');
		});
	}

}
