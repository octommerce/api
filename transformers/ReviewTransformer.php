<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Review;

class ReviewTransformer extends Transformer
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
        'product',
    ];

    public function data(Review $review)
    {
        return [
            'id'         => (int) $review->id,
            'product_id' => (int) $review->product_id,
            'user_id'    => (int) $review->user_id,
            'title'      => $review->title,
            'content'    => $review->content,
            'rating'     => $review->rating,
            'is_buyer'	 => (Boolean) $review->is_buyer
        ];
    }

    public function includeProduct(Review $review)
    {
        return $this->item($review->product, new ProductTransformer);
    }

}