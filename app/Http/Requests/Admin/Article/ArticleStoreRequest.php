<?php


namespace App\Http\Requests\Admin\Article;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ArticleStoreRequest
 * @package App\Http\Requests\Admin\Article
 *
 * @property array $name
 * @property array $description
 * @property integer $category_id
 * @property UploadedFile|null $photo
 */
class ArticleStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array|keysExist:languages,code',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array|keysExist:languages,code',
            'description.*' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
