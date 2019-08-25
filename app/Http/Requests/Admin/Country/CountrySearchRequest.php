<?php


namespace App\Http\Requests\Admin\Country;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountrySearchRequest
 * @package App\Http\Requests\Admin\Country
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $parent
 */
class CountrySearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:countries,id',
            'name' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
        ];
    }
}
