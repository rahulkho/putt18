<?php

namespace App\Http\Controllers;

use App\Entities\Players\Player;
use App\Entities\Players\PlayersRepository;

class PlayersController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	// use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(PlayersRepository $dataRepo, Player $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'Players';
		$this->entitySingular = 'player';
        $this->isDestroyingEntityAllowed = false;
	}

	protected function indexRouteName()
	{
		return 'manage.players.index';
	}

}
