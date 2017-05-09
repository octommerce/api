<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Product;

class OrderProductTransformer extends Transformer
{
    public function data(Product $product)
    {
        return [
            'id'       => (int) $product->id,
            'sku'      => $product->sku,
            'name'     => $product->pivot->name,
            'qty'      => (int) $product->pivot->qty,
            'price'    => (float) $product->pivot->price,
            'discount' => (float) $product->pivot->discount,
            'images'   => $this->images($product->images),
        ];
    }

}
