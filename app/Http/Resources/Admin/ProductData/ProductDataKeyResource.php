<?php


namespace App\Http\Resources\Admin\ProductData;


use App\Domain\Product\Entities\Facilities\DataKey;
use App\Http\Resources\BaseJsonResource;
use Illuminate\Http\Request;

/**
 * Class ProductDataKeyResource
 * @package App\Http\Resources\Admin\ProductData
 *
 * @mixin DataKey
 */
class ProductDataKeyResource extends BaseJsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name
        ];
    }
}
