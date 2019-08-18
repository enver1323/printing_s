<?php


namespace App\Http\Requests\Admin\Brand;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BrandSearchRequest
 * @package App\Http\Requests\Admin\Brand
 *
 * @property integer $id
 * @property string $name
 */
class BrandSearchRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:brands,id',
            'name' => 'nullable|string|max:255',
        ];
    }
}
