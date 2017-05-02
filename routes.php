<?php

    Route::group([
        'prefix' => 'api/v1',
        'namespace' => 'Octommerce\API\Controllers',
        'middleware' => 'cors'
        ], function() {
            Route::get('products', 'Products@index');
            Route::get('products/{id}', 'Products@show');

            Route::get('categories', 'Categories@index');
            Route::get('categories/{id}', 'Categories@show');

            Route::get('brands', 'Brands@index');
            Route::get('brands/{id}', 'Brands@show');

            Route::get('productlists', 'ProductLists@index');
            Route::get('productlists/{id}', 'ProductLists@show');

            Route::get('reviews', 'Reviews@index');
            Route::get('reviews/{id}', 'Reviews@show');


            Route::group(['middleware' => 'oauth'], function() {
                Route::get('cart', 'Cart@index');
                Route::post('cart', 'Cart@store');
                Route::put('cart', 'Cart@update');
                Route::delete('cart', 'Cart@destroy');

                Route::get('orders', 'Orders@index');
                Route::post('orders', 'Orders@store');
                Route::get('orders/{id}', 'Orders@show');
            });
    });

?>