<?php


namespace App\Http\Requests\Admin\Product;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductStoreRequest
 * @package App\Http\Requests\Admin\Product
 *
 * @property array $name
 * @property array $description
 * @property integer $category_id
 * @property integer $brand_id
 * @property double $lat
 * @property double $lng
 * @property UploadedFile $photo
 */
class ProductStoreRequest extends FormRequest
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
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'brand_id' => 'nullable|numeric|exists:brands,id',
            'line_id' => 'required|numeric|exists:lines,id'
        ];
    }
}
