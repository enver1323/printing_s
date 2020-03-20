<?php


namespace App\Http\Requests\Admin\Comment;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommentCreateRequest
 * @package App\Http\Requests\Comment
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property string $name
 * @property string $email
 * @property string $message
 */
class CommentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:255',
        ];
    }
}
