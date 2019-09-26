<?php


namespace App\Http\Resources\Admin\Brand;


use App\Domain\Brand\Entities\Brand;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\BaseJsonResource;
use Illuminate\Http\Request;

/**
 * Class CategoryResource
 * @package App\Http\Resources\Admin\Category
 *
 * @mixin Brand
 */
class BrandResource extends BaseJsonResource
{
    /**
     * @param Request $request
     * @return array|void
     */
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
            self::SLUG => $this->slug,
            self::DESCRIPTION => $this->description,
            self::CATEGORY => new CategoryResource($this->whenLoaded('category')),
            self::IMAGE => isset($this->photo) ? $this->photo->getUrl() : null,
        ];
    }
}
