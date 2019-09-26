<?php


namespace App\Http\Requests\Admin\Product;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductMediaUpdateRequest
 * @package App\Http\Requests\Admin\Product
 *
 * @property array $photos
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
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
