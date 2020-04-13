<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Cart;

class CartTransformer extends Transformer
{
    public $defaultIncludes = [
        'products',
    ];

    public $availableIncludes = [
        'products',
    ];

    public function data(Cart $cart)
    {
        return [
            'id'          => (int) $cart->id,
            'user_id'     => (int) $cart->user_id,
            'total_price' => (float) $cart->total_price,
            'created_at'  => date($cart->created_at),
        ];
    }

    public function includeProducts(Cart $cart)
    {
        return $this->collection($cart->products, new OrderProductTransformer);
    }

}
