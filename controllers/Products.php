<?php namespace Octommerce\API\Controllers;

use Input;
use Octobro\API\Classes\ApiController;
use Octommerce\Octommerce\Models\Product;
use Octommerce\API\Transformers\ProductTransformer;

class Products extends ApiController
{

    public function index()
    {
        $query = Product::published();

        $filter = Input::get('filter');
        $sortOrder = Input::get('sort');



        if ($filter) {


            // by category
            if (isset($filter['category']) && $filter['category']) {
                $categoryIds = explode(',',$filter['category']);
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
            // by Productlist
            if (isset($filter['list']) && $filter['list']) {
                $productListIds = explode(',',$filter['list']);
                foreach($productListIds as $productListId) {
                    $query->whereHas('lists', function($query) use ($productListId) {
                        $query->whereId($productListId);
                    });
                }
            }
            // by search
            if (isset($filter['search']) && $filter['search']) {
                $searchQuery = $filter['search'];

                $query->search($searchQuery);
            }
            // by stock
            if (isset($filter['outstock']) && $filter['outstock']) {
                $stock = $filter['outstock'];
                if ($stock == 'true') {
                    $query->available();
                }

            }
        }

        if($sortOrder)
        {
         if (in_array($sortOrder, array_keys(Product::$allowedSortingOptions))) {
            $sortOrderArray = explode(" ", $sortOrder);
                if ($sortOrder == 'random') {
                    $query->orderByRaw("RAND()");
                } elseif ($sortOrderArray[0] == 'sales') {

                    // order by product sold qty for the last 30 days
                    $query->join(DB::raw("
                        (
                            select product_id, sum(qty) as sold
                            from octommerce_octommerce_order_product
                            where order_id in
                            (
                                select id from octommerce_octommerce_orders
                                where DATEDIFF(NOW(), created_at) <= 30
                                and status_code NOT IN (\"expired\", \"waiting\")
                            )
                            group by product_id order by sold ". $sortOrderArray[1] ."
                        ) op
                        "), 'octommerce_octommerce_products.id', '=', 'op.product_id');

                } else {
                    $query->orderBy($sortOrderArray[0], $sortOrderArray[1]);
                }
            }
        }
        // Paginate
        $paginator = $query->paginate(Input::get('number', 20));

        return $this->respondWithPaginator($paginator, new ProductTransformer);
    }

    public function show($id)
    {
    	$product = Product::find($id);

        if (! $product) {
            return $this->errorNotFound('Product not found');
        }

    	return $this->respondwithItem($product, new ProductTransformer);
    }
}
