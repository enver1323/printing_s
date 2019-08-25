<?php


namespace App\Http\Requests\Admin\Product;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductUpdateRequest
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
class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array|keysExist:languages,code',
            'description.*' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'brand_id' => 'required|numeric|exists:brands,id',
//            'photos' => 'required|array',
//            'photos.*' => 'required|image|mimes:jpeg,jpg,png,gif,tif,svg',
            'lat' => 'nullable|between:-90,90',
            'lng' => 'nullable|between:-180,180',
        ];
    }

}
