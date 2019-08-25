<?php


namespace App\Http\Resources\Admin\Product;


use App\Domain\Product\Entities\Product;
use App\Http\Resources\Admin\Brand\BrandResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\BaseJsonResource;

/**
 * Class ProductResource
 * @package App\Http\Resources\Admin\Product
 *
 * @mixin Product
 */
class ProductResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
            self::SLUG => $this->slug,
            self::OPTIONS => ProductOptionResource::collection($this->whenLoaded('options')),
            self::CATEGORY => CategoryResource::collection($this->whenLoaded('category')),
            self::BRAND => BrandResource::collection($this->whenLoaded('brand')),
        ];
    }
}
