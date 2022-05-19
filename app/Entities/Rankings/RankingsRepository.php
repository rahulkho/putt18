<?php

namespace App\Entities\Rankings;

use App\Entities\BaseRepository;

class RankingsRepository extends BaseRepository
{

	public function __construct(Ranking $model)
	{
		parent::__construct($model);
	}

}