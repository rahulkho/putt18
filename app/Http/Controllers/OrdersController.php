<?php

namespace App\Http\Controllers;

use App\Entities\Orders\Order;
use App\Entities\Orders\OrdersRepository;

class OrdersController extends Controller
{

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	use \EMedia\Oxygen\Http\Controllers\Traits\HasHttpCRUD;

	protected $dataRepo;

	public function __construct(OrdersRepository $dataRepo, Order $model)
	{
		$this->model        = $model;
		$this->dataRepo     = $dataRepo;

        $this->entityPlural   = 'Orders';
		$this->entitySingular = 'order';
        $this->isDestroyingEntityAllowed = true;
	}

	protected function indexRouteName()
	{
		return 'manage.orders.index';
	}

}
