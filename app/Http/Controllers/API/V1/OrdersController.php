<?php


namespace App\Http\Controllers\API\V1;


use App\Entities\Orders\OrdersRepository;
use App\User;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Devices\Auth\DeviceAuthenticator;
use Illuminate\Http\Request;


class OrdersController extends APIBaseController
{

    /**
     * @var OrdersRepository
     */
    private $ordersRepo;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepo = $ordersRepo;
    }

    public function claimOrder(Request $request)
    {
        document(function () {
        	return (new APICall())
        	    ->setName('Claim an Order')
        	    ->setDescription('Claim an order ID and become a premium user')
        	    ->setParams([
                    new Param('order_id', 'string', 'Order ID to claim')
                ]);
        });

        $this->validate($request, [
            'order_id' => 'required',
        ]);

        // TODO: check business rules, and if multiple claims should be allowed on the same order

        $order = $this->ordersRepo->findByOrderId($request->order_id);

        if (!$order) {
            return response()->apiError("Order ID was invalid. Try again with another order ID. Please contact admin if you think the Order ID is valid.");
        }

        // associate user with the order ID and make them a premium user
        /** @var User $user */
        $user = DeviceAuthenticator::getUserByAccessToken();
        $user->order()->associate($order);
        $user->became_premium_at = now();
        $user->save();

        $order->is_claimed = true;
        $order->save();

        return response()->apiSuccess(true);
    }

}
