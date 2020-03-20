<?php


namespace App\Http\Requests\Admin\Page;


use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->isAdmin();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string|max:255',
            'content' => 'required|array|keysExist:languages,code',
            'content.*' => 'required|string|max:255',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|mimes:pdf'
        ];
    }
}
