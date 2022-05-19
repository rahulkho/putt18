<?php

namespace App\Entities\PlayTypes;

use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class PlayType extends Model
{

    const SINGLE = 'single';
    const TEAM = 'team';

    public static function getName($slug)
    {
        switch ($slug) {
            case self::SINGLE:
                return 'Single';
                break;
            case self::TEAM:
                return 'Team';
                break;
        }

        return false;
    }

    public static function getValidTypes()
    {
        return [self::SINGLE, self::TEAM];
    }

//	use SearchableTrait, RelationshipDataTrait;
//	use GeneratesFields;
//
//	// use \Cviebrock\EloquentSluggable\Sluggable;
//
//    /**
//     * Return the sluggable configuration array for this model.
//     *
//     * @return array
//     */
//    /*
//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'name'
//            ]
//        ];
//    }
//    */
//
//	protected $fillable = [
//		'name'
//	];
//
//	protected $searchable = [
//		'name'
//	];
//
//	protected $editable = [
//    	'name',
//    ];
//
//    protected $rules = [
//        'name' => 'required',
//    ];
//
//	protected $manyToManyRelations = [];

}
