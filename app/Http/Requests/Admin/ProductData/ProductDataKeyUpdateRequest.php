<?php


namespace App\Http\Requests\Admin\ProductData;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductDataKeyUpdateRequest
 * @package App\Http\Requests\Admin\ProductData
 */
class ProductDataKeyUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize():bool
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
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string'
        ];
    }
}
