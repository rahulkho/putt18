<?php


use App\Entities\PushNotifications\PushNotification;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class PushNotificationsTableSeeder extends Seeder
{
	public function run()
	{
		if (app()->environment('production')) return;

		$faker = Faker::create('en_AU');

		$seedUserCount = 3;

		foreach(range(1, $seedUserCount) as $index)
		{
			/** @var \App\User $user */
			$user = \App\User::inRandomOrder()->first();

			$push = new PushNotification();
			$push->title = $faker->sentence;
			$push->message = $faker->sentence;
			$push->scheduled_at = now();
			$push->scheduled_timezone = now()->timezoneName;
			$push->notifiable()->associate($user);
			$push->save();
		}
	}
}
