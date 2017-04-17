<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Models\Category;
use Octommerce\API\Transformers\CategoryTransformer;

class Categories extends ApiController
{

    public function index()
    {
        $categories = Category::get();

        return $this->respondwithCollection($categories, new CategoryTransformer);
    }

    public function show($id)
    {
    	$category = Category::find($id);

    	return $this->respondwithItem($category, new CategoryTransformer);
    }
}
