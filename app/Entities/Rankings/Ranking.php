<?php

namespace App\Entities\Rankings;

use App\Entities\Players\Player;
use EMedia\Formation\Entities\GeneratesFields;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use EMedia\QuickData\Entities\Traits\RelationshipDataTrait;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{

	use SearchableTrait, RelationshipDataTrait;
	use GeneratesFields;

	protected $fillable = [
	];

	protected $searchable = [

	];

	protected $editable = [

    ];

    protected $rules = [
        'player_id' => 'required',
    ];

	protected $manyToManyRelations = [];

	protected $dates = [
	    'last_updated_at',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

}
