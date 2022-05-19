<?php

use EMedia\AppSettings\Entities\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

	use \EMedia\QuickData\Database\Seeds\Traits\SeedsWithoutDuplicates;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        // $faker = \Faker\Factory::create('en_AU');

		// seed the settings, without creating any duplicates

		$data = [
            [
                'setting_key' => 'ABOUT_US',
                'setting_data_type' => 'text',
                'description' => 'Content for the about us screen.',
                'setting_value' => file_get_contents(database_path('seeds' . DIRECTORY_SEPARATOR . 'SeedData' . DIRECTORY_SEPARATOR . 'about_us.txt')),
                'is_key_editable'	=> false,
            ],
            [
                'setting_key' => 'PRIVACY_POLICY',
                'setting_data_type' => 'text',
                'description' => 'Content for application privacy policy.',
                'setting_value' => file_get_contents(database_path('seeds' . DIRECTORY_SEPARATOR . 'SeedData' . DIRECTORY_SEPARATOR . 'privacy_policy.txt')),
                'is_key_editable'	=> false,
            ],
            [
                'setting_key' => 'TERMS_AND_CONDITIONS',
                'setting_data_type' => 'text',
                'description' => 'Content for application terms and conditions.',
                'setting_value' => file_get_contents(database_path('seeds' . DIRECTORY_SEPARATOR . 'SeedData' . DIRECTORY_SEPARATOR . 'terms_conditions.txt')),
                'is_key_editable'	=> false,
            ],
            [
                'setting_key' => 'GAME_RULES',
                'setting_data_type' => 'text',
                'setting_value' => file_get_contents(database_path('seeds' . DIRECTORY_SEPARATOR . 'SeedData' . DIRECTORY_SEPARATOR . 'game_rules.txt')),
                'description' => 'Game rules.',
                'is_key_editable'	=> false,
            ],
            [
                'setting_key' => 'WEBSITE_URL',
                'setting_data_type' => 'string',
                'setting_value' => 'http://www.putt18.com.au',
                'description' => 'Official Website URL',
                'is_key_editable' => false,
            ],
            [
                'setting_key' => 'INSTAGRAM_URL',
                'setting_data_type' => 'string',
                'setting_value' => 'http://www.instagram.com/' . \Illuminate\Support\Str::kebab(config('app.name')),
                'description' => 'Official Instagram URL',
                'is_key_editable' => false,
            ],
            [
                'setting_key' => 'FACEBOOK_URL',
                'setting_data_type' => 'string',
                'setting_value' => 'http://www.facebook.com/' . \Illuminate\Support\Str::kebab(config('app.name')),
                'description' => 'Official Facebook URL',
                'is_key_editable' => false,
            ],
            [
                'setting_key' => 'TWITTER_URL',
                'setting_data_type' => 'string',
                'setting_value' => 'http://www.twitter.com/' . \Illuminate\Support\Str::kebab(config('app.name')),
                'description' => 'Official Twitter URL',
                'is_key_editable' => false,
            ],
            [
                'setting_key' => 'SNAPCHAT_URL',
                'setting_data_type' => 'string',
                'setting_value' => 'http://www.snap.com/' . \Illuminate\Support\Str::kebab(config('app.name')),
                'description' => 'Official Snapchat URL',
                'is_key_editable' => false,
            ],
		];

		$this->seedButDontCreateDuplicates($data, Setting::class, 'setting_key', 'setting_key');
	}
}
