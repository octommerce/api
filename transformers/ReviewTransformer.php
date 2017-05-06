<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Review;

class ReviewTransformer extends Transformer
{
    public $availableIncludes = [
        'products',
    ];

    public function data(Review $review)
    {
        return [
            'id'          => (int) $review->id,
            'product_id'        => $review->product_id,
            'user_id'        => $review->user_id,
            'title' => $review->title,
            'content'      => $review->content,
            'rating'    => $review->rating,
            'is_buyer'	=> $review->is_buyer
        ];
    }

    public function includeProducts(Review $review)
    {
        return $this->collection($review->products, new ProductTransformer);
    }

}