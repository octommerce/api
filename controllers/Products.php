<?php namespace Octommerce\API\Controllers;

use Input;
use Event;
use League\Fractal\Resource\Collection;
use Octobro\API\Controllers\ApiController;
use Octommerce\Octommerce\Models\Product;
use Octommerce\API\Transformers\ProductTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class Products extends ApiController
{

    public function index()
    {
        $query = Product::published();

        $filter = Input::get('filter');



        if ($filter) {


            // by category
            if (isset($filter['category']) && $filter['category']) {
                $categoryIds = explode(',', $filter['category']);
                foreach($categoryIds as $categoryId) {
                    $query->whereHas('categories', function($query) use ($categoryId) {
                        $query->whereId($categoryId);
                    });
                }
            
            }

            // by brand
            if (isset($filter['brand']) && $filter['brand']) {
                $brandId = $filter['brand'];

                $query->whereHas('brand', function($query) use ($brandId) {
                    $query->whereId($brandId);
                });
            }
        }

        // Paginate
        $paginator = $query->paginate(Input::get('number', 20));

        return $this->respondWithPaginator($paginator, new ProductTransformer);
    }

    public function show($id)
    {
    	$product = Product::find($id);

    	return $this->respondwithItem($product, new ProductTransformer);
    }
}
