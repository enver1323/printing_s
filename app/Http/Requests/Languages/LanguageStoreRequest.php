<?php

namespace App\Http\Requests\Languages;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|alpha|max:2|unique:languages,code',
            'name' => 'required|string|max:255',
        ];
    }
}
