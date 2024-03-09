<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/products', \App\Admin\Controllers\ProductController::class);
    $router->resource('/salesmen', \App\Admin\Controllers\SalesManController::class);
    $router->resource('/suppliers', \App\Admin\Controllers\SuppliersController::class);
});
