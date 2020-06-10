<?php


namespace App\Http\Requests\Admin\Brand;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class BrandStoreRequest
 * @package App\Http\Requests\Admin\Brand
 *
 * @property array $name
 * @property array $description
 * @property integer $category_id
 * @property UploadedFile|null $photo
 */
class BrandStoreRequest extends FormRequest
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
            'description.*' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
