<?php namespace Octommerce\API\Controllers;

use Auth;
use Input;
use Octommerce\Octommerce\Models\Order;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Classes\OrderManager;
use Octommerce\API\Transformers\OrderTransformer;

class Orders extends ApiController
{
    public function store() {
        $orderManager = OrderManager::instance();

        $data = Input::get();

        Auth::login($this->user);

        $order = $orderManager->create($data);

        return $this->respondwithItem($order, new OrderTransformer);
    }
}
