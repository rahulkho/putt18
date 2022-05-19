<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id');
            $table->string('device_type');
            $table->text('device_push_token')->nullable();
            $table->integer('user_id')->nullable()->references('id')->on('users');
            $table->string('access_token')->nullable();
			$table->dateTime('access_token_expires_at')->nullable();
			$table->string('latest_ip_address')->nullable();
			$table->unique(['device_id', 'device_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('devices');
    }
}
