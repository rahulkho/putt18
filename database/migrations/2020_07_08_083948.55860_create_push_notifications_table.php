<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationsTable extends \Illuminate\Database\Migrations\Migration
{

	public function up()
	{
		Schema::create('push_notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('uuid')->unique();
			$table->string('title');
			$table->text('message');
			$table->unsignedInteger('badge_count')->nullable();
			$table->text('data')->nullable();
			$table->dateTime('scheduled_at');
			$table->string('scheduled_timezone');
			$table->dateTime('sent_at')->nullable();
			$table->dateTime('read_at')->nullable();
			$table->nullableMorphs('notifiable');
			$table->string('topic')->nullable();
			$table->text('apns_config')->nullable();
			$table->text('android_config')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('push_notifications');
	}

}
