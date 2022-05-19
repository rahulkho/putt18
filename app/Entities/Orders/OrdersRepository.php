<?php

namespace App\Entities\Orders;

use App\Entities\BaseRepository;

class OrdersRepository extends BaseRepository
{

	public function __construct(Order $model)
	{
		parent::__construct($model);
	}

    public function findByOrderId($orderId)
    {
        return Order::where('order_id', $orderId)->first();
    }

}
