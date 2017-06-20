<?php namespace Octommerce\API\Controllers;

use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Review;
use Octommerce\API\Transformers\ReviewTransformer;

class Reviews extends ApiController
{

    public function index()
    {
      
        $paginator = Review::paginate(Input::get('number', 20));
        return $this->respondWithPaginator($paginator, new ReviewTransformer);
    }

    public function show($id)
    {
    	$review = Review::find($id);

    	return $this->respondwithItem($review, new ReviewTransformer);
    }
}
