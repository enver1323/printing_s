<?php


namespace App\Http\Requests\Admin\Category;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryUpdateRequest
 * @package App\Http\Requests\Admin\Category
 *
 * @property array $name
 * @property integer $parent_id
 */
class CategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->user();
        return isset($user) && $user->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
