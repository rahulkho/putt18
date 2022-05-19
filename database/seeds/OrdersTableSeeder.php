<?php

use App\Entities\Orders\Order;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('en_AU');

		$order = Order::where('order_id', '7777')->get()->first();
		if (!$order) {
            Order::create([
                'order_id' => '7777',
            ]);
		}

		foreach(range(1, 10) as $index)
		{
			Order::create([
				'order_id'		    => $faker->numberBetween(50000, 60000),
			]);
		}
	}

}
