<?php


namespace App\Http\Requests\Admin\Line;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class LineStoreRequest
 * @package App\Http\Requests\Admin\Line
 *
 * @property array $name
 * @property array $description
 * @property integer $category_id
 * @property UploadedFile|null $photo
 */
class LineStoreRequest extends FormRequest
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
        ];
    }
}
