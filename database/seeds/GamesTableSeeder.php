<?php

use App\Entities\Games\Game;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		foreach(range(1, 10) as $index)
		{
		    $user = \App\User::inRandomOrder()->limit(1)->get()->first();
		    check_all_present($user);

			Game::create([
			    'user_id' => $user->id,
				'game_type' => $faker->randomElement([
				    \App\Entities\GameTypes\GameType::HOLE_9,
				    \App\Entities\GameTypes\GameType::HOLE_18,
				]),
				'play_type' => $faker->randomElement([
				    \App\Entities\PlayTypes\PlayType::SINGLE,
                    \App\Entities\PlayTypes\PlayType::TEAM,
                ]),
                'player_order' => $faker->randomElement(['manual', 'auto']),
                'has_wildcards' => $faker->boolean,
                'has_animations' => $faker->boolean,
                'team_max_player_limit' => $faker->numberBetween(1, 6),
                'game_max_player_limit' => $faker->numberBetween(1, 6),
                'starts_at' => $faker->dateTimeBetween(now(), now()->addMonth()),
			]);
		}
	}

}
