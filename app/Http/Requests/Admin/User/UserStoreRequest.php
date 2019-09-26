<?php

namespace App\Http\Requests\Admin\User;

use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests\Admin\User
 *
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $status
 * @property string $password
 * @property array $profile
 */
class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'role' => ['required', Rule::in(User::getRoles())],
            'password' => 'required|string|min:6|max:255|confirmed',
        ];
    }
}
