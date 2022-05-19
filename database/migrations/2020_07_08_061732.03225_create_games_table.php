<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->id('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->location();
            $table->string('game_type')->nullable();    // See GameType
            $table->string('play_type')->nullable();    // See PlayType
            $table->string('player_order')->default('manual');      // auto or manual
            $table->boolean('has_wildcards')->default(false);
            $table->boolean('has_animations')->default(false);
            $table->integer('team_max_player_limit')->nullable();
            $table->integer('game_max_player_limit')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->softDeletes();
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
		Schema::drop('games');
	}

}
