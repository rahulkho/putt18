<?php


namespace App\Http\Controllers\API\V1;


use App\Entities\Faqs\Faq;
use App\Entities\Faqs\FaqsRepository;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\AppSettings\Facades\Setting;

class FAQsController extends APIBaseController
{

    /**
     *
     * Guest settings
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        document(function () {
            return (new APICall())
                ->setName('FAQs')
                ->setDescription('FAQs and answers')
                ->setParams([
                    (new Param('q', 'Integer', 'Page number'))
                ])
                ->noDefaultHeaders()->setHeaders([
                    (new Param('Accept', 'String', '`application/json`'))->setDefaultValue('application/json'),
                    (new Param('x-api-key', 'String', 'API Key'))->setDefaultValue('123123123123'),
                ])
                ->setSuccessPaginatedObject(Faq::class)
                ->setSuccessExample('{
					"payload": {
						"Add your response here"
					},
					"message": "",
					"result": true
				}');
        });

        /** @var FaqsRepository $dataRepo */
        $dataRepo = app(FaqsRepository::class);

        $results = $dataRepo->search();

        return response()->apiSuccess($results);
    }

}
