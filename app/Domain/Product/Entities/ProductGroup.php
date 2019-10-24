<?php


namespace App\Domain\Product\Entities;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface ProductGroup
{
    /**
     * @return HasMany
     */
    public function products(): HasMany;
}
