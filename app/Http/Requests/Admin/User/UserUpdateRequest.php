<?php

namespace App\Http\Requests\Admin\User;

use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Admin\User
 * @property string $name
 * @property string $email
 */
class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email,' . $this->user()->id,
            'role' => ['required', Rule::in(User::getRoles())],
            'password' => 'nullable|string|min:6|max:255|confirmed',
        ];
    }
}
