<?php

//Route::get('/', function () {
//    return redirect(app()->getLocale());
//});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

    Route::group(
        [
            'prefix' => 'cabinet',
            'as' => 'cabinet.',
            'namespace' => 'Cabinet',
            'middleware' => ['auth'],
        ],
        function () {
            Route::get('/', 'HomeController@index')->name('home');
        }
    );

    /**
     * Admin routes
     */
    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin.',
            'namespace' => 'Admin',
            'middleware' => ['auth', 'can:admin.panel'],
        ],
        function () {
            Route::get('/', 'HomeController@index')->name('home');

            /** Users routes */
            Route::resource('users', 'UserController');
            Route::group([
                'as' => 'users.',
                'prefix' => 'users',
            ], function () {
                Route::group([
                    'as' => 'profiles.',
                    'prefix' => 'profiles',
                ], function () {
                    Route::delete('{profile}/photo/delete', 'UserController@deleteProfilePhoto')
                        ->name('photo.delete');
                });
            });

            /** Languages routes */
            Route::resource('languages', 'LanguageController');

            /** Regions routes */
            Route::resource('regions', 'RegionController')->except(['index']);
            Route::group([
                'as' => 'regions.',
                'prefix' => 'regions'
            ], function () {
                Route::get('create/{country}/{region?}', 'RegionController@create')->name('create');
            });

            /** Categories routes */
            Route::resource('categories', 'CategoryController');
            Route::group([
                'as' => 'categories.',
                'prefix' => 'categories'
            ], function () {
                Route::get('create/{category?}', 'CategoryController@create')->name('create');
                Route::group([
                    'as' => 'move.',
                    'prefix' => 'move/{category}'
                ], function (){
                    Route::get('up', 'CategoryController@moveUp')->name('up');
                    Route::get('down', 'CategoryController@moveDown')->name('down');
                });
            });

            /** Brands routes */
            Route::resource('brands', 'BrandController');
            Route::group([
                'as' => 'brands.',
                'prefix' => 'brands',
            ], function () {
                Route::delete('{brand}/photo/delete', 'BrandController@deletePhoto')
                    ->name('photo.delete');
            });
        }
    );
});
