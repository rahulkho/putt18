<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRankingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rankings', function(Blueprint $table)
		{
			$table->id('id');
            $table->bigInteger('player_id')->references('id')->on('players');
            $table->integer('movement')->default(0);        // positive or negative movement from last update
            $table->timestamp('last_updated_at');
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
		Schema::drop('rankings');
	}

}
