<?php

namespace App\Entities\Players;

use App\User;
use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
	}

}
