<?php


namespace App\Http\Resources\Admin\Line;


use App\Domain\Line\Entities\Slide;
use App\Http\Resources\BaseJsonResource;

/**
 * Class LineResource
 * @package App\Http\Resources\Admin\Line
 *
 * @mixin Slide
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
