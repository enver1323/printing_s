<?php


namespace App\Http\Requests\Admin\Article;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ArticleUpdateRequest
 * @package App\Http\Requests\Admin\Article
 *
 * @property array $name
 * @property array $description
 * @property integer $category_id
 * @property UploadedFile|null $photo
 */
class ArticleUpdateRequest extends FormRequest
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
