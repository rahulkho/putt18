<?php

namespace App\Entities\Faqs;

use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

	use SearchableTrait, RelationshipDataTrait;
	use GeneratesFields;

	protected $fillable = [
		'question',
		'answer',
	];

	protected $searchable = [
        'question',
        'answer',
	];

	protected $editable = [
        'question',
        [
            'type' => 'textarea',
            'name' => 'answer',
        ],
    ];

    protected $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

	protected $manyToManyRelations = [];

}
