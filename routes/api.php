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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'as' => 'ajax.',
    'prefix' => 'ajax',
    'namespace' => 'API',
    'middleware' => ['ajax']
], function () {
    Route::get('brands', 'AjaxAdminController@getBrands')->name('brands');
    Route::get('regions', 'AjaxAdminController@getRegions')->name('regions');
    Route::get('products', 'AjaxAdminController@getProducts')->name('products');
    Route::get('languages', 'AjaxAdminController@getLanguages')->name('languages');
    Route::get('countries', 'AjaxAdminController@getCountries')->name('countries');
    Route::get('categories', 'AjaxAdminController@getCategories')->name('categories');
});
