<?php


namespace App\Http\Requests\Admin\ProductData;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductDataKeyStoreRequest
 * @package App\Http\Requests\Admin\ProductData
 *
 * @property
 */
class ProductDataKeyStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return isset($user);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string'
        ];
    }
}
