<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Product;

class ProductTransformer extends Transformer
{
    public $availableIncludes = [
        'categories',
        'brand',
        'reviews',
        'relatedProducts'
    ];

    public function data(Product $product)
    {
        return [
            'id'                => (int) $product->id,
            'sku'               => $product->sku,
            'name'              => $product->name,
            'description'       => $product->description,
            'price'             => (float) $product->price,
            'sale_price'        => (float) $product->sale_price,
            'discount_start_at' => $product->discount_start_at,
            'discount_end_at'   => $product->discount_end_at,
            'images'            => $this->images($product->images),
        ];
    }

    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, new CategoryTransformer);
    }

    public function includeReviews(Product $product)
    {
        return $this->collection($product->reviews, new ReviewTransformer);
    }

    public function includeBrand(Product $product)
    {
        return $this->item($product->brand, new BrandTransformer);
    }

    public function includeRelatedProducts(Product $product)
    {
        return $this->collection($product->related_products, new ProductTransformer);
    }
}
