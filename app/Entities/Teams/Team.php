<?php

namespace App\Entities\Teams;

use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

	use SearchableTrait, RelationshipDataTrait;
	use GeneratesFields;

	// use \Cviebrock\EloquentSluggable\Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    /*
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    */

	protected $fillable = [
		'name'
	];

	protected $searchable = [
		'name'
	];

	protected $editable = [
    	'name',
    ];

    protected $rules = [
        'name' => 'required',
    ];

	protected $manyToManyRelations = [];

}