<?php

use App\Entities\Auth\AbilityCategory;
use EMedia\QuickData\Database\Seeds\Traits\SeedsWithoutDuplicates;
use Illuminate\Database\Seeder;

class AbilityCategoriesTableSeeder extends Seeder
{

	use SeedsWithoutDuplicates;

	public function run()
	{
		$this->seedAbilityCategories();
	}

	public function seedAbilityCategories()
	{
		$abilityCategories = [
			// user-management
			[
				'name' => 'User Management',
				'default_abilities' => [
					'Add Users',
					'Edit Users',
					'Delete Users',
					'Disable Users',
					'Enable Users',
				]
			],

			// permission management
			[
				'name' => 'Permission Management',
				'default_abilities' => [
					'View Permissions',
					'Add Permissions',
					'Edit Permissions',
					'Delete Permissions',
				]
			],

			// group (role) management
			[
				'name' => 'Group Management',
				'default_abilities' => [
					'View Groups',
					'Add Groups',
					'Edit Groups',
					'Delete Groups',

					'Add Group Users',
					'View Group Users',
					'Edit Group Users',
					'Edit Group Permissions',

					'Invite Group Users',
				]
			],
		];

		// convert array to a JSON string
		$abilityCategories = array_map(function ($abilityCategoryData) {
			$abilityCategoryData['default_abilities'] = json_encode($abilityCategoryData['default_abilities']);
			return $abilityCategoryData;
		}, $abilityCategories);

		$this->seedButDontCreateDuplicates($abilityCategories, AbilityCategory::class);
	}

	public function appendDataToExistingModel($entity, $entityData)
	{
		// append new abilities if any
		$newAbilities = json_decode($entityData['default_abilities']);
		$existingAbilities = json_decode($entity->default_abilities);
		$mergedAbilities = array_unique(array_merge($newAbilities, $existingAbilities));

		if (count($mergedAbilities) > count($existingAbilities)) {
			$entity->default_abilities = json_encode($mergedAbilities);
			$entity->save();
		}
	}

}
