<?php

namespace App\Entities\Teams;

use App\Entities\BaseRepository;

class TeamsRepository extends BaseRepository
{

	public function __construct(Team $model)
	{
		parent::__construct($model);
	}

}