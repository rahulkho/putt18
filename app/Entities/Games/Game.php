<?php

namespace App\Entities\Games;

use App\Entities\GameTypes\GameType;
use App\Entities\PlayTypes\PlayType;
use App\User;
use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{

	use SearchableTrait, RelationshipDataTrait;
	use GeneratesFields;
	use SoftDeletes;

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
	    'formatted_address',
	    'street',
	    'street_2',
	    'city',
	    'state',
	    'country',
	    'country_iso_code',

		'game_type',
		'play_type',

		'game_max_player_limit',
		'team_max_player_limit',

		'player_order',
		'has_wildcards',
		'has_animations',
	];

	protected $searchable = [
		'formatted_address'
	];

	protected $editable = [
    	'name',
    ];

    protected $rules = [
        'date' => 'required',
        'time' => 'required',
        'formatted_address' => 'required',
        'country' => 'required',
        'country_iso_code' => 'required|max:3',
        'game_type' => 'required',
        'play_type' => 'required',
        'game_max_player_limit' => 'required',
        'team_max_player_limit' => 'required_if',
        'player_order' => 'required',
        'has_wildcards' => 'required',
        'has_animations' => 'required',
    ];

    protected $dates = [
        'starts_at',
    ];

	protected $manyToManyRelations = [];

	public function getGameTypeNameAttribute() {
	    return GameType::getName($this->game_type);
	}

    public function getPlayTypeNameAttribute() {
        return PlayType::getName($this->play_type);
	}

	public function getStatusNameAttribute() {
	    // TODO: update label condition
	    return 'Active';
	}

    public function createdByUser()
    {
        return $this->belongsTo(User::class);
	}

}
