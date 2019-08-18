<?php


namespace App\Http\Requests\Admin\Language;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LanguageStoreRequest
 * @package App\Http\Requests\Admin\Language
 *
 * @property string $code
 * @property string $name
 */
class LanguageStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:2|unique:languages,code',
            'name' => 'required|string|max:255'
        ];
    }
}
