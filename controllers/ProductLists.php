<?php namespace Octommerce\API\Controllers;

use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\ProductList;
use Octommerce\API\Transformers\ProductListTransformer;

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
