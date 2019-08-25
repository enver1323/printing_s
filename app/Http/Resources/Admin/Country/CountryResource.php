<?php

namespace App\Http\Resources\Admin\Country;

use App\Domain\Country\Entities\Country;
use App\Http\Resources\BaseJsonResource;

/**
 * Class CountryResource
 * @package App\Http\Resources\Admin
 *
 * @mixin Country
 */
class CountryResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
            self::IMAGE => $this->photo->getUrl() ?? null
        ];
    }
}
