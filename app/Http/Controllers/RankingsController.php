<?php

namespace App\Http\Controllers;

use App\Entities\Rankings\Ranking;
use App\Entities\Rankings\RankingsRepository;

class RankingsController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(RankingsRepository $dataRepo, Ranking $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'Leaderboard';
		$this->entitySingular = 'Ranking';
        $this->isDestroyingEntityAllowed = false;
	}

	protected function indexRouteName()
	{
		return 'manage.rankings.index';
	}

}
