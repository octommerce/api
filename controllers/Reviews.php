<?php namespace Octommerce\API\Controllers;

use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Review;
use Octommerce\API\Transformers\ReviewTransformer;

class Reviews extends ApiController
{

    public function index()
    {
        $review = Review::get();

        return $this->respondwithCollection($review, new ReviewTransformer);
    }

    public function show($id)
    {
    	$review = Review::find($id);

    	return $this->respondwithItem($review, new ReviewTransformer);
    }
}
