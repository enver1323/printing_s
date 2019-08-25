<?php


namespace App\Http\Requests\Admin\Country;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountryUpdateRequest
 * @package App\Http\Requests\Admin\Country
 *
 * @property array $name
 * @property string $slug
 * @property integer $parent_id
 * @property float $lat
 * @property float $lng
 * @property string $code
 */
class CountryUpdateRequest extends FormRequest
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
            'lat' => 'nullable|between:-90,90',
            'lng' => 'nullable|between:-180,180',
            'code' => 'nullable|string|max:255',
        ];
    }
}
