<?php

namespace App\Entities\Auth;

use Cviebrock\EloquentSluggable\Sluggable;
use EMedia\Oxygen\Entities\Auth\SingleTenant\Ability as AbilityBase;

class Ability extends AbilityBase
{

	use Sluggable;

	protected $fillable = ['name', 'title'];

	public function sluggable()
	{
		return [
			'name' => [
				'source' => 'title',
				'maxLength' => 150,
			]
		];
	}

	public function category()
	{
		return $this->belongsTo(AbilityCategory::class, 'ability_category_id');
	}

	/**
	 * Get the ability's "slug" attribute.
	 *
	 * @return string
	 */
	public function getSlugAttribute()
	{
		$slug = (!empty($this->attributes['name']))? $this->attributes['name']: '';

		if ($this->attributes['entity_type']) {
			$slug .= '-'.$this->attributes['entity_type'];
		}

		if ($this->attributes['entity_id']) {
			$slug .= '-'.$this->attributes['entity_id'];
		}

		if ($this->attributes['only_owned']) {
			$slug .= '-owned';
		}

		return strtolower($slug);
	}

}