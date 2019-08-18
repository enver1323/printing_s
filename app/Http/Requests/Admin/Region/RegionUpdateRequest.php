<?php


namespace App\Http\Requests\Admin\Region;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountryUpdateRequest
 * @package App\Http\Requests\Admin\Country
 *
 * @property array $name
 * @property string $slug
 * @property integer $country_id
 * @property integer $parent_id
 * @property float $lat
 * @property float $lng
 */
class RegionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string',
            'parent_id' => 'nullable|numeric|exists:regions,id',
            'country_id' => 'required|numeric|exists:countries,id',
            'lat' => 'nullable|between:-90,90',
            'lng' => 'nullable|between:-180,180',
        ];
    }
}
