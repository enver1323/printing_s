<?php


namespace App\Http\Requests\Admin\ProductData;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductDataKeySearchRequest
 * @package App\Http\Requests\Admin\ProductData
 *
 * @property integer $id
 * @property string $name
 */
class ProductDataKeySearchRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:data_keys,id',
            'name' => 'nullable|string'
        ];
    }
}
