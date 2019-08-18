<?php


namespace App\Http\Requests\Admin\Category;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategorySearchRequest
 * @package App\Http\Requests\Admin\Category
 *
 * @property integer $id
 * @property string $name
 */
class CategorySearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:categories,id',
            'name' => 'nullable|string|max:255'
        ];
    }
}
