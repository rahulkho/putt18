<?php


namespace App\Http\Controllers\API\V1;


use App\Entities\Rankings\RankingsRepository;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\QuickData\Entities\Search\SearchFilter;
use Illuminate\Http\Request;

class LeaderboardController extends APIBaseController
{

    /**
     * @var RankingsRepository
     */
    private $rankingsRepo;

    public function __construct(RankingsRepository $rankingsRepo)
    {
        $this->rankingsRepo = $rankingsRepo;
    }

    public function index(Request $request)
    {
        document(function () {
        	return (new APICall())
        	    ->setName('Get Rankings')
        	    ->setParams([
                    (new Param('p', 'integer', 'Page number. Default will be 1'))->optional(),
                    (new Param('country_code', 'string', 'ISO Country code'))->optional(),
                    (new Param('state'))->optional(),
                ]);
        });

        $filter = new SearchFilter();
        // $filter->where('country_code', $request->country_code);

        // TODO: update the filter and flatten the results

        $rankings = $this->rankingsRepo->search(['ranking.player.user', $filter]);

        return response()->apiSuccessPaginated($rankings);
    }

}
