<?php

namespace App\Entities\Players;

use App\Entities\BaseRepository;

class PlayersRepository extends BaseRepository
{

	public function __construct(Player $model)
	{
		parent::__construct($model);
	}

}