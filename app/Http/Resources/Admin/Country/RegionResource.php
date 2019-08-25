<?php

namespace App\Http\Resources\Admin\Country;

use App\Domain\Country\Entities\Region;
use App\Http\Resources\BaseJsonResource;

/**
 * Class RegionResource
 * @package App\Http\Resources\Admin\Country
 *
 * @mixin Region
 */
class RegionResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
        ];
    }
}
