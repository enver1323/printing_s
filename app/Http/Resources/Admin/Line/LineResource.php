<?php


namespace App\Http\Resources\Admin\Line;


use App\Domain\Line\Entities\Line;
use App\Http\Resources\BaseJsonResource;

/**
 * Class LineResource
 * @package App\Http\Resources\Admin\Line
 *
 * @mixin Line
 */
class LineResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
        ];
    }
}
