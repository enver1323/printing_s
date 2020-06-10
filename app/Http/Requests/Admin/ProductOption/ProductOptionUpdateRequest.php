<?php


namespace App\Http\Requests\Admin\ProductOption;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductOptionUpdateRequest
 * @package App\Http\Requests\Admin\ProductOption
 *
 * @property array $name
 * @property array $description
 */
class ProductOptionUpdateRequest extends FormRequest
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
            'name.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ];
    }
}
