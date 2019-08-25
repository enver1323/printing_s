<?php


namespace App\Http\Requests\Admin\Product;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductSearchRequest
 * @package App\Http\Requests\Admin\Product
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 */
class ProductSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:products,id',
            'name' => 'nullable|string|max:255',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'brand_id' => 'nullable|numeric|exists:brands,id',
        ];
    }
}
