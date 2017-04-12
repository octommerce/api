<?php

    Route::group([
        'prefix' => 'api/v1',
        'namespace' => 'Octommerce\API\Controllers',
        'middleware' => 'cors'
        ], function() {
            Route::get('products', 'Products@index');
            Route::get('brands', 'Brands@index');
            Route::get('productlists', 'ProductLists@index');
            Route::get('categories', 'Categories@index');

            Route::get('cart', 'Cart@index');
            Route::post('cart', 'Cart@store');
            Route::put('cart', 'Cart@store');
            Route::delete('cart', 'Cart@destroy');

            Route::group(['middleware' => 'oauth'], function() {
                //
            });
    });

?>