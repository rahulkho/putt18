<?php

namespace App\Http\Controllers;

use App\Entities\Faqs\Faq;
use App\Entities\Faqs\FaqsRepository;

class FaqsController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(FaqsRepository $dataRepo, Faq $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'FAQs';
		$this->entitySingular = 'FAQ';
        $this->isDestroyingEntityAllowed = false;
	}

	protected function indexRouteName()
	{
		return 'manage.faqs.index';
	}

}
