<?php


namespace App\Http\Requests\Admin\ProductData;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductDataValueStoreRequest
 * @package App\Http\Requests\Admin\ProductData
 *
 * @property array $values
 */
class ProductDataValueUpdateRequest extends FormRequest
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
            'values' => 'required|array',
            'values.*.value' => 'required|array',
            'values.*.value.*' => 'required|string',
        ];
    }
}
