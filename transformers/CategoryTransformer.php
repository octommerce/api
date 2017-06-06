<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Category;

class CategoryTransformer extends Transformer
{
    public $defaultIncludes = [];

    public $availableIncludes = [
        'products',
    ];

    public function data(Category $category)
    {
        return [
            'id'          => (int) $category->id,
            'slug'        => $category->slug,
            'name'        => $category->name,
            'description' => $category->description,
            'images'      => $this->images($category->images),
            'color'       => $category->color,
            'keywords'    => $category->keywords,
        ];
    }

    public function includeProducts(Category $category)
    {
        return $this->collection($category->products, new ProductTransformer);
    }

}