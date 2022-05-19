<?php

use Faker\Factory as Faker;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{

	public function run()
	{
		if (app()->environment() !== 'production') {
			$this->seedTenants();
		}
	}

	public function seedTenants()
	{
		$faker = Faker::create('en_AU');
		$tenantModel = config('auth.tenantModel');
		if (!$tenantModel) throw new BindingResolutionException('auth.tenantModel is not configured in settings');

		foreach(range(1, 10) as $index)
		{
			app($tenantModel)->create([
				'company_name'	=> $faker->company
			]);
		}
	}

}
