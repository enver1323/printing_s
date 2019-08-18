<?php


namespace App\Http\Requests\Admin\User;


use App\Domain\User\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UserSearchRequest
 * @package App\Http\Requests\Admin\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $role
 */
class UserSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:users,id',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'status' => ['nullable','string','max:255', Rule::in(User::getStatuses())],
            'role' => ['nullable','alpha_dash','max:16', Rule::in(User::getRoles())],
        ];
    }
}
