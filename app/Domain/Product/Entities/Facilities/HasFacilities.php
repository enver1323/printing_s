<?php


namespace App\Domain\Product\Entities\Facilities;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * Interface HasFacilities
 * @package App\Domain\Product\Entities\Facilities
 *
 * @property DataValue[]|Collection $dataValues
 */
interface HasFacilities
{
    public function dataValues(): MorphMany;
}
