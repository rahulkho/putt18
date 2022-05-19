<?php

use App\Entities\Players\Player;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		foreach(range(1, 20) as $index)
		{
		    $isGuest = $faker->boolean;

		    $user = null;
		    if (!$isGuest) {
		        $user = \App\User::inRandomOrder()->limit(1)->get()->first();
		        check_all_present($user);
		    }

		    $player = new Player();
		    $player->user_id = $user ? $user->id: null;
		    if ($isGuest) {
		        $player->guest_name = $faker->firstName;
		        $player->guest_email = $faker->email;
		        $player->guest_phone_iso = $faker->e164PhoneNumber;
		        $player->guest_invite_code = null;
		    }

		    $player->save();
		}
	}

}
