<?php

namespace App\Entities\Orders;

use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
		'order_id'
	];

	protected $searchable = [
		'order_id'
	];

	protected $editable = [
    	'order_id',
    ];

    protected $rules = [
        'order_id' => 'required',
    ];

	protected $manyToManyRelations = [];

}
