<?php


namespace App\Http\Requests\Admin\Comment;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommentSearchRequest
 * @package App\Http\Requests\Comment
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 */
class CommentSearchRequest extends FormRequest
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
            'id' => 'nullable|integer',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:255',
        ];
    }
}
