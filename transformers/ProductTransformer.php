<?php namespace Octommerce\API\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Octommerce\Models\Product;

class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
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