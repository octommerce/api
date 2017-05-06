<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Brand;

class BrandTransformer extends Transformer
{
    public $defaultIncludes = [];

    public $availableIncludes = [
        'products',
    ];

    public function data(Brand $brand)
    {
        return [
            'id'          => (int) $brand->id,
            'slug'        => $brand->slug,
            'name'        => $brand->name,
            'description' => $brand->description,
            'images'      => $brand->images,
            'keywords'    => $brand->keywords,
        ];
    }

    public function includeProducts(Brand $brand)
    {
        return $this->collection($brand->products, new ProductTransformer);
    }

}