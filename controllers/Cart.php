<?php namespace Octommerce\API\Controllers;

use Cart as CartHelper;
use Octobro\API\Classes\ApiController;
use Octommerce\API\Transformers\CartTransformer;

class Cart extends ApiController
{
    public function index()
    {
        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

    public function store()
    {
        CartHelper::clear();

        foreach ($this->data['products'] as $product) {
        	CartHelper::addItem($product['id'], isset($product['qty']) ? $product['qty'] : 1, isset($product['data']) ? $product['data'] : null);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

	public function update()
    {
        foreach ($this->data['products'] as $product) {
            CartHelper::updateItem($product['id'], isset($product['qty']) ? $product['qty'] : 1, isset($product['data']) ? $product['data'] : null);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }

    public function destroy()
    {
        foreach ($this->data['products'] as $product) {
            CartHelper::removeItem($product['id']);
        }

        return $this->respondwithItem(CartHelper::get(), new CartTransformer);
    }
}