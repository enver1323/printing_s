<?php


namespace App\Http\Requests\Admin\Language;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LanguageSearchRequest
 * @package App\Http\Requests\Admin\Language
 *
 * @property string $code
 * @property string $name
 */
class LanguageSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'nullable|string|max:2|exists:languages,code',
            'name' => 'nullable|string|max:255'
        ];
    }
}
