<?php namespace Octommerce\API\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Octommerce\Models\Brand;

class BrandTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
        'products',
    ];

    public function transform(Brand $brand)
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