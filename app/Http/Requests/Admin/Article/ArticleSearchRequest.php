<?php


namespace App\Http\Requests\Admin\Article;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleSearchRequest
 * @package App\Http\Requests\Admin\Article
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $author
 */
class ArticleSearchRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->isAdmin();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:articles,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'author' => 'nullable|numeric|exists:users,id'
        ];
    }
}
