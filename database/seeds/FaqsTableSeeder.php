<?php

use App\Entities\Faqs\Faq;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		foreach(range(1, 10) as $index)
		{
			Faq::create([
				'question'		    => $faker->sentence,
				'answer'        	=> $faker->paragraph,
			]);
		}
	}

}
