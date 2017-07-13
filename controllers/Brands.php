<?php namespace Octommerce\API\Controllers;

use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Brand;
use Octommerce\API\Transformers\BrandTransformer;

class Brands extends ApiController
{

    public function index()
    {

        $paginator = Brand::paginate(Input::get('number', 20));

        return $this->respondWithPaginator($paginator, new BrandTransformer);
    }

    public function show($id)
    {
    	$brand = Brand::find($id);

        if (! $brand) {
            return $this->errorNotFound('Brand not found');
        }

    	return $this->respondwithItem($brand, new BrandTransformer);
    }
}
