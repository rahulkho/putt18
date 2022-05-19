<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function(Blueprint $table)
		{
			$table->id('id');
            $table->integer('user_id')->nullable()->references('id')->on('users');

            // guest info
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone_iso')->nullable();
            $table->string('guest_invite_code')->nullable();
            $table->timestamp('guiest_invite_expires_at')->nullable();

            // player data
            $table->integer('match_count')->default(0);
            $table->integer('lowest_score')->nullable();
            $table->integer('average_score')->nullable();

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
		Schema::drop('players');
	}

}
