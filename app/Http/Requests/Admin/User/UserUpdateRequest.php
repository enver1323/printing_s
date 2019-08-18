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
            'email' => 'required|string|max:255|email|unique:users,id,' . $this->user()->id,
            'role' => ['required', Rule::in(User::getRoles())],
            'status' => ['required', Rule::in(User::getStatuses())],
            'password' => 'nullable|string|min:6|max:255|confirmed',

            'profile' => 'required|array',
            'profile.name' => 'required|string|max:255',
            'profile.family_name' => 'nullable|string|max:255',
            'profile.nickname' => 'nullable|string|max:255',
            'profile.birth_date' => 'nullable|string|max:255|date_format:Y-m-d',
            'profile.gender' => ['nullable', Rule::in(Profile::getGenders())]
        ];
    }
}
