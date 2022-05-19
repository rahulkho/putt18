<?php


namespace App\Http\Controllers\API\V1;


use App\Entities\Games\Game;
use App\Entities\Games\GamesRepository;
use App\Entities\GameTypes\GameType;
use App\Entities\PlayTypes\PlayType;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Devices\Auth\DeviceAuthenticator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GamesController extends APIBaseController
{

    /**
     * @var GamesRepository
     */
    private $gamesRepo;

    public function __construct(GamesRepository $gamesRepo)
    {
        $this->gamesRepo = $gamesRepo;
    }

    /**
     *
     * Query games for this user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EMedia\Devices\Auth\DeviceNotFoundException
     * @throws \EMedia\Helpers\Exceptions\Auth\UserNotFoundException
     */
    public function index(Request $request)
    {
        document(function () {
        	return (new APICall())
        	    ->setName('List Games')
                ->setParams([
                    (new Param('p', 'integer', 'Page number. Default will be 1'))->optional(),
                    (new Param('status', 'string', 'Accepted values `active`. Default is `all`'))->optional(),
                    (new Param('game_type', 'string', 'Accepted values `hole-18`, `hole-9`'))->optional(),
                    (new Param('play_type', 'string', 'Accepted values `single`, `team`'))->optional(),
                    // TODO: add other filter values here
                ]);
        });

        /** @var User $user */
        $user = DeviceAuthenticator::getUserByAccessToken();

        // filter by user/player
        // TODO: find the qualified games for this user, when they're a player
        $query = Game::where(function ($q) use ($user) {
        	$q->user_id = $user->id;
        });

        // filter game_type
        if ($request->has('game_type')) {
            if (in_array($request->game_type, GameType::getValidTypes())) {
                $query->where('game_type', $request->game_type);
            }
        }

        // filter play_type
        if ($request->has('play_type')) {
            if (in_array($request->play_type, GameType::getValidTypes())) {
                $query->where('play_type', $request->play_type);
            }
        }

        $games = $query->paginate();

        return response()->apiSuccessPaginated($games);

    }

    /**
     *
     * Create a new game
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setName('Create Game')
                ->setParams([
                    new Param('date', 'string', 'Date in DD/Mon/YYYY format'),
                    new Param('time', 'string', 'Time in HH:MM AA format'),

                    // location
                    new Param('formatted_address', 'string', 'Displayed name of the venue'),
                    (new Param('street', 'string', 'Address line 1'))->optional(),
                    (new Param('street_2', 'string', 'Address line 2'))->optional(),
                    (new Param('city', 'string', 'Time in HH:MM AA format'))->optional(),
                    new Param('state', 'string', 'Time in HH:MM AA format'),
                    new Param('country', 'string', 'Name of country'),
                    new Param('country_iso_code', 'string', 'ISO code of venue country'),

                    // other
                    new Param('game_type', 'string', 'Accepted values `hole-18`, `hole-9`'),
                    new Param('play_type', 'string', 'Accepted values `single`, `team`'),

                    new Param('game_max_player_limit', 'integer', 'Total players for game'),
                    (new Param('team_max_player_limit', 'integer', 'Required for `team` games'))->optional(),

                    new Param('player_order', 'string', 'Accepted values `auto`, `manual`'),
                    new Param('has_wildcards', 'boolean', 'Accepted values `true`, `false`'),
                    new Param('has_animations', 'boolean', 'Accepted values `true`, `false`'),

                    // add other params here
                ])
                ->setSuccessObject(Game::class);
        });

        $this->validate($request, [
            'date' => 'required|date_format:',
            'time' => 'required|date_format:',
            'formatted_address' => 'required',
            'country' => 'required',
            'country_iso_code' => 'required|max:3',
            'game_type' => [
                'required',
                Rule::in(GameType::getValidTypes())
            ],
            'play_type' => [
                'required',
                Rule::in(PlayType::getValidTypes())
            ],
            'game_max_player_limit' => 'required',
            'team_max_player_limit' => 'required_if|play_type,team',
            'player_order' => 'required|in:auto,manual',
            'has_wildcards' => 'required|boolean',
            'has_animations' => 'required|boolean',
        ]);


        $input = $request->all();

        /** @var User $user */
        $user = DeviceAuthenticator::getUserByAccessToken();

        /** @var Game $game */
        $game = $this->gamesRepo->create($input);
        $game->createdByUser()->associate($user);
        $game->save();

        return response()->apiSuccess($game);
    }

}
