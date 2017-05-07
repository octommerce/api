<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\ProductList;

class ProductListTransformer extends Transformer
{
    public $defaultIncludes = [];

    public $availableIncludes = [
        'products',
    ];

    public function data(ProductList $productList)
    {
        return [
            'id'           => (int) $productList->id,
            'slug'         => $productList->slug,
            'name'         => $productList->name,
            'description'  => $productList->description,
            'content'      => $productList->content,
            'excerpt'      => $productList->excerpt,
            'keywords'	   => $productList->keywords,
            'partial_path' => $productList->partial_path,
        ];
    }

    public function includeProducts(ProductList $productList)
    {
        return $this->collection($productList->products, new ProductTransformer);
    }

}