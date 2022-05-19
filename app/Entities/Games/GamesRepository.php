<?php

namespace App\Entities\Games;

use App\Entities\BaseRepository;

class GamesRepository extends BaseRepository
{

	public function __construct(Game $model)
	{
		parent::__construct($model);
	}

}