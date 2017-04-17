<?php namespace Octommerce\API\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Octommerce\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
        'products',
    ];

    public function transform(Category $category)
    {
        return [
            'id'          => (int) $category->id,
            'slug'        => $category->slug,
            'name'        => $category->name,
            'description' => $category->description,
            'images'      => $category->images,
            'color'       => $category->color,
            'keywords'    => $category->keywords,
        ];
    }

    public function includeProducts(Category $category)
    {
        return $this->collection($category->products, new ProductTransformer);
    }

}