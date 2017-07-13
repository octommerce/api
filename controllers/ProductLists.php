<?php namespace Octommerce\API\Controllers;

use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\ProductList;
use Octommerce\API\Transformers\ProductListTransformer;

class ProductLists extends ApiController
{

    public function index()
    {
        $paginator = ProductList::paginate(Input::get('number', 20));
       	return $this->respondWithPaginator($paginator, new ProductListTransformer);
    }

    public function show($id)
    {
    	$productList = ProductList::find($id);

        if (! $productList) {
            return $this->errorNotFound('Product list not found');
        }

    	return $this->respondwithItem($productList, new ProductListTransformer);
    }
}
