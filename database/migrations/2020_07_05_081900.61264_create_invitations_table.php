<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invitations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->references('id')->on('roles');
			$table->string('email');
			$table->string('invitation_code');
			$table->integer('referrer_id')->nullable()->references('id')->on('users');
			$table->string('referrer_ip')->nullable();
			$table->dateTime('sent_at')->nullable();
			$table->dateTime('claimed_at')->nullable();
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
		Schema::drop('invitations');
	}

}
