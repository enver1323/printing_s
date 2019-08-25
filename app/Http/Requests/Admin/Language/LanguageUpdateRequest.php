<?php


namespace App\Http\Requests\Admin\Language;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LanguageUpdateRequest
 * @package App\Http\Requests\Admin\Language
 *
 * @property string $name
 */
class LanguageUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}
