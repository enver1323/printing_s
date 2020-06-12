<?php


namespace App\Http\Requests\Admin\Page;


use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return isset($user) && $user->isAdmin();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'content' => 'required|array',
            'content.*' => 'required|string',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|mimes:pdf'
        ];
    }
}
