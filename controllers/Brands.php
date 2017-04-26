<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Models\Brand;
use Octommerce\API\Transformers\BrandTransformer;

class Brands extends ApiController
{

    public function index()
    {
        $brand = Brand::get();

        return $this->respondwithCollection($brand, new BrandTransformer);
    }

    public function show($id)
    {
    	$brand = Brand::find($id);

    	return $this->respondwithItem($brand, new BrandTransformer);
    }
}
