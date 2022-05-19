<?php

use App\Entities\Teams\Team;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		foreach(range(1, 10) as $index)
		{
			Team::create([
				'name'		    => $faker->sentence,
				// 'description'	=> $faker->paragraph
			]);
		}
	}

}
