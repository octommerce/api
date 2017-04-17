<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Models\Product;
use Octommerce\API\Transformers\ProductTransformer;

class Products extends ApiController
{

    public function index()
    {
        $products = Product::get();

        return $this->respondwithCollection($products, new ProductTransformer);
    }

    public function show($id)
    {
    	$product = Product::find($id);

    	return $this->respondwithItem($product, new ProductTransformer);
    }
}
