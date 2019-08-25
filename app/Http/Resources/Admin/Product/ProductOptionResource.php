<?php


namespace App\Http\Resources\Admin\Product;


use App\Domain\Product\Entities\ProductOption;
use App\Http\Resources\BaseJsonResource;
use Illuminate\Http\Request;

/**
 * Class ProductOptionResource
 * @package App\Http\Resources\Admin\Product
 *
 * @mixin ProductOption
 */
class ProductOptionResource extends BaseJsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
        ];
    }
}
