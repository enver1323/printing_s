<?php

//Route::get('/', function () {
//    return redirect(app()->getLocale());
//});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
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

    /** Admin routes */
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

            /** Articles routes */
            Route::resource('articles', 'ArticleController');

            /** Languages routes */
            Route::resource('languages', 'LanguageController');

            /** Slides routes */
            Route::resource('slides', 'SlideController');
            Route::group([
                'as' => 'slides.',
                'prefix' => 'slides/{slide}',
            ], function () {
                Route::get('left', 'SlideController@imageLeft')->name('left');
                Route::get('right', 'SlideController@imageRight')->name('right');
            });

            /** Categories routes */
            Route::resource('categories', 'CategoryController');

            /** Lines routes */
            Route::resource('lines', 'LineController');

            /** Brands routes */
            Route::resource('brands', 'BrandController');
            Route::group([
                'as' => 'brands.',
                'prefix' => 'brands',
            ], function () {
                Route::delete('{brand}/photo/delete', 'BrandController@deletePhoto')->name('photo.delete');
            });

            /** Products routes */
            Route::resource('products', 'ProductController');
            Route::group([
                'as' => 'products.',
                'prefix' => 'products',
            ], function () {
                /** ProductMedia Routes */
                Route::group([
                    'as' => 'media.',
                    'prefix' => '{product}/media'
                ], function () {
                    Route::get('show', 'ProductMediaController@mediaShow')->name('show');
                    Route::patch('update', 'ProductMediaController@mediaUpdate')->name('update');

                    /** ProductImages Routes */
                    Route::group([
                        'as' => 'image.',
                        'prefix' => 'image/{image}'
                    ], function () {
                        Route::get('left', 'ProductMediaController@imageLeft')->name('toLeft');
                        Route::get('right', 'ProductMediaController@imageRight')->name('toRight');
                        Route::get('delete', 'ProductMediaController@imageDelete')->name('delete');
                    });
                });

                Route::group([
                    'as' => 'data.',
                    'prefix' => 'data',
                ], function () {
                    /** ProductDataValues routes */
                    Route::group([
                        'as' => 'values.',
                        'prefix' => '{product}/values',
                    ], function () {
                        Route::get('/', 'ProductController@showValues')->name('show');
                        Route::post('/update', 'ProductController@updateValues')->name('update');
                    });

                    /** ProductDataKeys routes */
                    Route::resource('keys', 'ProductDataKeyController');
                });

                /** ProductOptions routes */
                Route::resource('options', 'ProductOptionController')->except(['index']);
                Route::group([
                    'as' => 'options.',
                    'prefix' => 'options',
                ], function () {
                    Route::get('{product}/create', 'ProductOptionController@create')->name('create');
                    Route::group([
                        'as' => 'data.',
                        'prefix' => 'data',
                    ], function () {
                        /** ProductDataValues routes */
                        Route::group([
                            'as' => 'values.',
                            'prefix' => '{option}/values',
                        ], function () {
                            Route::get('/', 'ProductOptionController@showValues')->name('show');
                            Route::post('/update', 'ProductOptionController@updateValues')->name('update');
                        });
                    });
                });
            });
        }
    );

    /** Frontend routes */
    Route::group([
        'namespace' => 'Web'
    ], function () {
        /** Index Routes */
        Route::get('/', 'IndexController@index')->name('main');
        Route::get('/contacts', 'IndexController@contacts')->name('contacts');

        /** Products Routes */
        Route::group([
            'as' => 'products.',
            'prefix' => 'products'
        ], function () {
            Route::get('categories/{category?}', 'ProductController@categoryList')->name('category');
            Route::get('brands/{brand?}', 'ProductController@brandList')->name('brand');
            Route::get('{product}', 'ProductController@show')->name('show');
        });

        /** Articles Routes */
        Route::group([
            'as' => 'articles.',
            'prefix' => 'articles'
        ], function() {
            Route::get('', 'ArticleController@index')->name('index');
            Route::get('{article}', 'ArticleController@show')->name('show');
        });
    });
});
