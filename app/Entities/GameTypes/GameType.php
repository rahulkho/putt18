<?php

namespace App\Entities\GameTypes;

use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{

    const HOLE_9 = 'hole-9';
    const HOLE_18 = 'hole-18';

    public static function getName($slug)
    {
        switch ($slug) {
            case self::HOLE_9:
                return '9 Hole Strokeplay';
                break;
            case self::HOLE_18:
                return '18 Hole Strokeplay';
                break;
        }

        return false;
    }

    public static function getValidTypes()
    {
        return [self::HOLE_9, self::HOLE_18];
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
