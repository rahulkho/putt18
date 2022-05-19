<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_players', function (Blueprint $table) {
            $table->bigInteger('team_id')->references('id')->on('teams');
            $table->bigInteger('player_id')->references('id')->on('players');
            $table->primary(['team_id', 'player_id'], 'team_players_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('team_players', function (Blueprint $table) {
            $table->dropIndex('team_players_unique');
        });
        Schema::dropIfExists('team_players');
    }
}
