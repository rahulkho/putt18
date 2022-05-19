<?php

use App\User;
use EMedia\MultiTenant\Facades\TenantManager;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

	public function run()
	{
		if (app()->environment() !== 'production') {
			$this->seedTestUsers();
			$this->seedRegularUsers();
		}
	}

	public function seedRegularUsers()
	{
		$faker = Faker::create('en_AU');

		User::create([
			'name'	 => 'Bruce Wayne (REGULAR USER)',
			'email'	 => 'apps+user@elegantmedia.com.au',
			'password' => bcrypt('12345678')
		]);

		foreach(range(1, 10) as $index)
		{
			$user = User::create([
				'name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'email' => $faker->email,
				'password' => bcrypt('12345678'),
			]);

			$user->assign('user');
		}
	}

	public function seedTestUsers()
	{
		$users = [
			[
				'name'	 => 'Peter Parker (SUPER ADMIN)',
				'email'	 => 'apps@elegantmedia.com.au',
				'password' => bcrypt('12345678')
			],
			[
				'name'	 => 'Tony Stark (ADMIN)',
				'email'	 => 'apps+admin@elegantmedia.com.au',
				'password' => bcrypt('12345678')
			],
		];

		$i = 0;
		foreach ($users as $key => $data) {
			if (!$user = User::where('email', $data['email'])->first()) {
				$user = User::create($data);

				if (TenantManager::multiTenancyIsActive()) {
					$tenant = app(config('auth.tenantModel'))->find($i + 1);
					TenantManager::setTenant($tenant);
					$user->tenants()->save($tenant);
				}
			}
			$i++;
		}
	}
}
