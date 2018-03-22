<?php namespace Octommerce\API\Controllers;

use Auth;
use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Order;
use Octommerce\Octommerce\Classes\OrderManager;
use Octommerce\API\Transformers\OrderTransformer;

class Orders extends ApiController
{

	public function index()
    {
        $paginator = $this->getUser()->orders()->orderBy('created_at', 'desc')->paginate(Input::get('number', 20));
        return $this->respondWithPaginator($paginator, new OrderTransformer);

    }

    public function store()
    {
        $orderManager = OrderManager::instance();

        Auth::login($this->getUser());

        $order = $orderManager->create($this->data);

        return $this->respondwithItem($order, new OrderTransformer);
    }

    public function show($id)
    {
        $order = $this->getUser()->orders()->whereId($id)->first();

		if (! $order) {
            return $this->errorNotFound('Order not found');
        }

        return $this->respondwithItem($order, new OrderTransformer);
    }

    public function update($id)
    {
        $order = $this->getUser()->orders()->whereId($id)->first();

		if (! $order) {
            return $this->errorNotFound('Order not found');
        }

        $order->fill($this->data);
        $order->save();

        return $this->respondwithItem($order, new OrderTransformer);
    }
}
