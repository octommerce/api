<?php namespace Octommerce\API\Controllers;

use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Category;
use Octommerce\API\Transformers\CategoryTransformer;

class Categories extends ApiController
{

    public function index()
    {

        $paginator = Category::paginate(Input::get('number', 20));

        return $this->respondWithPaginator($paginator, new CategoryTransformer);
    }

    public function show($id)
    {
    	$category = Category::find($id);

        if (! $category) {
            return $this->errorNotFound('Category not found');
        }

    	return $this->respondwithItem($category, new CategoryTransformer);
    }
}
