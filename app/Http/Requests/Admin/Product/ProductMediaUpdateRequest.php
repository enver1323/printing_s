<?php


namespace App\Http\Requests\Admin\Product;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductMediaUpdateRequest
 * @package App\Http\Requests\Admin\Product
 *
 * @property array $photos
 * @property UploadedFile $manual
 */
class ProductMediaUpdateRequest extends FormRequest
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
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'manual' => 'nullable|mimes:pdf'
        ];
    }
}
