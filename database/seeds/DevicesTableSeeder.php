<?php


use EMedia\Devices\Entities\Devices\Device;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{

	use \EMedia\QuickData\Database\Seeds\Traits\SeedsWithoutDuplicates;

	public function run()
	{
		$data = [
			[
				'device_id' => 112233,
				'device_type' => 'apple',
				'device_push_token' => '23232323232323',
				'user_id' => 1,
				'access_token' => Device::newUniqueToken('access_token'),
			],
			[
				'device_id' => 332211,
				'device_type' => 'android',
				'device_push_token' => '500500500500500',
				'access_token' => Device::newUniqueToken('access_token'),
			],
			[
				'device_id' => 33221155,
				'device_type' => 'android',
				'device_push_token' => '500500500500600',
				'user_id' => 3,
				'access_token' => Device::newUniqueToken('access_token'),
			],
		];

		$this->seedButDontCreateDuplicates($data, Device::class, 'device_id', 'device_id');
	}

}