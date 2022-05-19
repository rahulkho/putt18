<?php

namespace App\Entities\Auth;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use EMedia\QuickData\Entities\Search\SearchableTrait;

class AbilityCategory extends Model
{

	use SearchableTrait;
	use Sluggable;

	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	protected $fillable            = ['name', 'default_abilities'];
	protected $manyToManyRelations = [];
	protected $searchable 		   = ['name'];

	public function abilities()
	{
		return $this->hasMany(app(config('oxygen.abilityModel')));
	}

}