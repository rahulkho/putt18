<?php

namespace App\Entities\Faqs;

use App\Entities\BaseRepository;

class FaqsRepository extends BaseRepository
{

	public function __construct(Faq $model)
	{
		parent::__construct($model);
	}

}