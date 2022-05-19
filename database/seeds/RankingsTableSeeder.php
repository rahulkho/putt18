<?php

use App\Entities\Rankings\Ranking;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RankingsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		$players = \App\Entities\Players\Player::inRandomOrder()->limit(20)->get();

		// clear existing rankings
		Ranking::truncate();

		foreach ($players as $player) {
		    $rank = new Ranking();
		    $rank->player()->associate($player);
		    $rank->movement = $faker->numberBetween(-10, 10);
		    $rank->last_updated_at = now();
		    $rank->save();
		}
	}

}
