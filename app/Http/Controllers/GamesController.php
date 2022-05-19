<?php

namespace App\Http\Controllers;

use App\Entities\Games\Game;
use App\Entities\Games\GamesRepository;

class GamesController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(GamesRepository $dataRepo, Game $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'Games';
		$this->entitySingular = 'game';
        $this->isDestroyingEntityAllowed = true;
	}

	protected function indexRouteName()
	{
		return 'manage.games.index';
	}

    public function show($id)
    {
        $game = $this->dataRepo->find($id);
        if (!$game) {
            return back()->with('error', 'Game not found for given ID');
        }

        $data = [
            'pageTitle' => 'Game Scorecard',
            'game' => $game,
        ];

        return view('manage.games.show', $data);
	}

}
