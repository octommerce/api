<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Product;

class ProductTransformer extends Transformer
{
    public $defaultIncludes = [];

    public $availableIncludes = [
        'categories',
        'brand',
    ];

    public function transform(Product $product)
    {
        return [
            'id'          => (int) $product->id,
            'sku'         => $product->sku,
            'name'        => $product->name,
            'description' => $product->description,
            'price'       => $product->price,
            'sale_price'  => $product->sale_price,
            'images'      => $product->images,
        ];
    }

    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, new CategoryTransformer);
    }

    public function includeBrand(Product $product)
    {
        return $this->item($product->brand, new BrandTransformer);
    }

}
