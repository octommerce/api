<?php namespace Octommerce\API\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Octommerce\Models\Cart;

class CartTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'products',
    ];

    protected $availableIncludes = [
        'products',
    ];

    public function transform(Cart $cart)
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
        return $this->collection($cart->products, new ProductTransformer);
    }

}
