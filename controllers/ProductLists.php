<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use League\Fractal\Resource\Collection;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Models\ProductList;
use Octommerce\API\Transformers\ProductListTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ProductLists extends ApiController
{

    public function index()
    {
    	$productLists = ProductList::get();
       	return $this->respondwithCollection($productLists, new ProductListTransformer);
    }

    public function show($id)
    {
    	$productLists = ProductList::find($id);

    	return $this->respondwithItem($productLists, new ProductListTransformer);
    }
}
