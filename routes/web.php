<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'indexController@indexShow');
    Route::get('search/{search}', 'indexController@searchItem');
    Route::get('search', 'indexController@getsearch');
    Route::get('searchprice', 'indexController@searchPrice');
    Route::get('product', 'indexController@product');
    Route::get('product-render-{id}', 'indexController@productDetail');
    Route::get('list-product-render-{id}', 'indexController@listProduct');
    Route::get('blog-{id}', 'indexController@blog');
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'cartController@cartShow');
        Route::post('/', 'cartController@addItem');
        Route::get('delete/{id}', 'cartController@deleteItem');
        Route::get('pay', 'cartController@pay');
        Route::post('pay', 'cartController@payPost');
    });
});
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'checklogin'], function () {
        Route::get('/', 'indexController@indexShow');

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'categoryController@listAll');
            Route::post('/', 'categoryController@addItem');
            Route::get('update', 'categoryController@updateItem');
            Route::get('delete/{id}', 'categoryController@deleteItem');
        });
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'productController@listAll');
            Route::get('add', 'productController@addShow');
            Route::post('add', 'productController@addItem');
            Route::get('update/{id}', 'productController@updateShow');
            Route::post('update/{id}', 'productController@updateItem');
            Route::get('delete/{id}', 'productController@deleteItem');
        });
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'blogController@listAll');
            Route::get('add', 'blogController@addShow');
            Route::post('add', 'blogController@addItem');
            Route::get('update/{id}', 'blogController@updateShow');
            Route::post('update/{id}', 'blogController@updateItem');
            Route::get('delete/{id}', 'blogController@deleteItem');
        });
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', 'cartController@listAll');
            Route::get('delete/{id}', 'cartController@deleteItem');
            Route::get('detail/{id}', 'cartController@detailItem');
            Route::get('update/{id}/{status}', 'cartController@updateStatus');
        });
    });

    //-------------------------------------------
    Route::group(['prefix' => 'login', 'middleware' => 'checklogout'], function () {
        Route::get('/', 'indexController@showLogin');
        Route::post('/', 'indexController@checkLogin');
    });
    Route::get('logout', 'indexController@logout');
    Route::get('register', 'indexController@showRegister');
    Route::post('register', 'indexController@register');
});
