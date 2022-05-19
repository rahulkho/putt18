<?php

namespace App\Http\Controllers;

use App\Entities\Teams\Team;
use App\Entities\Teams\TeamsRepository;

class TeamsController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	// use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(TeamsRepository $dataRepo, Team $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'Teams';
		$this->entitySingular = 'Team';
        $this->isDestroyingEntityAllowed = false;
	}

	protected function indexRouteName()
	{
		return 'manage.teams.index';
	}

}
