<?php


namespace App\Http\Resources\Admin\Language;


use App\Domain\Translation\Entities\Language;
use App\Http\Resources\BaseJsonResource;
use Illuminate\Http\Request;

/**
 * Class LanguageResource
 * @package App\Http\Resources\Admin\Language
 *
 * @mixin Language
 */
class LanguageResource extends BaseJsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            self::CODE => $this->code,
            self::NAME => $this->name
        ];
    }
}
