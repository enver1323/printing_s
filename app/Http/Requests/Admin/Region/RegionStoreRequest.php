<?php


namespace App\Http\Requests\Admin\Region;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountryStoreRequest
 * @package App\Http\Requests\Admin\Country
 *
 * @property array $name
 * @property string $slug
 * @property string $code
 * @property integer $parent_id
 * @property float $lat
 * @property float $lng
 */
class RegionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string',
            'country_id' => 'required|numeric|exists:countries,id',
            'parent_id' => 'nullable|numeric|exists:regions,id',
            'lat' => 'nullable|between:-90,90',
            'lng' => 'nullable|between:-180,180',
        ];
    }
}