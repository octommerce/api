<?php namespace Octommerce\API\Controllers;

use Auth;
use Input;
use Cart as CartHelper;
use Octobro\API\Controllers\ApiController;
use Octommerce\API\Transformers\CartTransformer;

class Cart extends ApiController
{
    public function index() {

        Auth::login($this->user);

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

    public function store() {

        $data = Input::get();

        Auth::login($this->user);

        CartHelper::clear();

        foreach ($data['products'] as $product) {
        	CartHelper::addItem($product['id'], isset($product['qty']) ? $product['qty'] : 1, isset($product['data']) ? $product['data'] : null);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

	public function update() {
    }

    public function destroy() {

        Auth::login($this->user);

        CartHelper::clear();
    }
}