<?php

namespace App\Entities\Auth;

use App\Entities\BaseRepository;

class AbilityCategoryRepository extends BaseRepository
{

	public function __construct()
	{
		$model = new AbilityCategory();
		parent::__construct($model);
	}

	public function addAbilities($category, $abilities)
	{
		if (is_string($abilities)) {
			$abilities = explode(',', $abilities);
			foreach ($abilities as $abilityName) {
				$abilityName = trim($abilityName);
				if (!empty($abilityName)) {
					$ability = app(config('oxygen.abilityModel'));
					$ability->title = trim($abilityName);
					$ability->ability_category_id = $category->id;
					$ability->save();
				}
			}
		}
	}

}