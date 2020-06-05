<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'as' => 'ajax.',
    'prefix' => 'ajax',
    'namespace' => 'API',
    'middleware' => ['ajax']
], function () {
    Route::get('users', 'AjaxAdminController@getUsers')->name('users');
    Route::get('brands', 'AjaxAdminController@getBrands')->name('brands');
    Route::get('products', 'AjaxAdminController@getProducts')->name('products');
    Route::group([
        'as' => 'data.',
        'prefix' => 'data'
    ], function (){
        Route::get('keys', 'AjaxAdminController@getDataKeys')->name('keys');
    });
    Route::get('languages', 'AjaxAdminController@getLanguages')->name('languages');
    Route::get('categories', 'AjaxAdminController@getCategories')->name('categories');
    Route::get('lines', 'AjaxAdminController@getLines')->name('lines');
});
