<?php


namespace App\Http\Resources\Admin\Category;


use App\Domain\Category\Entities\Category;
use App\Http\Resources\BaseJsonResource;

/**
 * Class CategoryResource
 * @package App\Http\Resources\Admin\Category
 *
 * @mixin Category
 */
class CategoryResource extends BaseJsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|void
     */
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
            self::PARENT => new CategoryResource($this->whenLoaded('parent')),
            self::CHILDREN => CategoryResource::collection($this->whenLoaded('descendants')),
            self::DEPTH => $this->depth
        ];
    }
}
