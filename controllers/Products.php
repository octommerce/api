<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use Octommerce\Octommerce\Models\Product;
use Octobro\API\Controllers\ApiController;

class Products extends ApiController
{

    public function index()
    {
        $products = Product::get();

        return $this->respondwithCollection($products, new ProductTransformer);
    }
}
