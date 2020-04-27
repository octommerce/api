<?php namespace Octommerce\API\Controllers;

use Auth;
use Cart as CartHelper;
use Octobro\API\Classes\ApiController;
use Octommerce\API\Transformers\CartTransformer;

class Cart extends ApiController
{
    public function index()
    {
        Auth::login($this->getUser());

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

    public function store()
    {
        Auth::login($this->getUser());

        // CartHelper::clear();

        foreach ($this->data['products'] as $product) {
        	CartHelper::addItem($product['id'], isset($product['qty']) ? $product['qty'] : 1, isset($product['data']) ? $product['data'] : null);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

	public function update()
    {
        Auth::login($this->getUser());

        foreach ($this->data['products'] as $product) {
            CartHelper::updateItem($product['id'], isset($product['qty']) ? $product['qty'] : 1, isset($product['data']) ? $product['data'] : null);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

    public function destroy($productId)
    {
        Auth::login($this->getUser());

        // foreach ($this->data['products'] as $product) {
        //     CartHelper::removeItem($product['id']);
        // }

        CartHelper::removeItem($productId);

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }
}