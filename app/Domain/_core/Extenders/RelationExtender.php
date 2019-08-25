<?php


namespace App\Domain\_core\Extenders;


use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use Illuminate\Database\Eloquent\Relations\Relation;

class RelationExtender implements Extender
{

    /**
     * Registers extenders, macros and morphs
     */
    public static function extend(): void
    {
        Relation::morphMap([
            'products' => Product::class,
            'productOptions' => ProductOption::class,
        ]);
    }
}
