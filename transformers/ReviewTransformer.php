<?php namespace Octommerce\API\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Octommerce\Models\Review;

class ReviewTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
        'product',
    ];

    public function transform(Review $review)
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

    public function includeProduct(Review $review)
    {
        return $this->item($review->product, new ProductTransformer);
    }

}