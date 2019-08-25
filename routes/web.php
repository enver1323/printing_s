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
                Route::patch('{user}/verify', 'UserController@verify')->name('verify');
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

            /** Countries routes */
            Route::resource('countries', 'CountryController');
            Route::group([
                'as' => 'countries.',
                'prefix' => 'countries',
            ], function () {
                Route::delete('{country}/photo/delete', 'CountryController@deletePhoto')->name('photo.delete');
            });

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
                ], function () {
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

            /** Products routes */
            Route::resource('products', 'ProductController');
            Route::group([
                'as' => 'products.',
                'prefix' => 'products',
            ], function () {
                Route::delete('{product}/photo/delete', 'ProductController@deletePhoto')
                    ->name('photo.delete');

                Route::group([
                    'as' => 'data.',
                    'prefix' => 'data',
                ], function () {
                    /** ProductDataKeys routes */
                    Route::resource('keys', 'ProductDataController');
                    Route::group([
                        'as' => 'keys.',
                        'prefix' => 'keys',
                    ], function () {
                        Route::get('{category?}/create', 'ProductDataController@create')->name('create');
                    });

                });

                /** ProductOptions routes */
                Route::resource('options', 'ProductOptionController')->except(['index']);
                Route::group([
                    'as' => 'options.',
                    'prefix' => 'options',
                ], function () {
                    Route::get('{product}/create', 'ProductOptionController@create')->name('create');
                });
            });
        }
    );
});
