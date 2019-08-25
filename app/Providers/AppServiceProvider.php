<?php

namespace App\Providers;

use App\Domain\_core\Extenders\CollectionExtender;
use App\Domain\_core\Extenders\RelationExtender;
use App\Domain\_core\Extenders\ValidatorExtender;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ValidatorExtender::extend();
        CollectionExtender::extend();
        RelationExtender::extend();
    }
}
