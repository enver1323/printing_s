<?php

namespace App\Entities\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserModel
 * @package App\Entites\Users
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Authenticatable
{
    const ROLE_USER = 'user';

    protected $table = 'users';

    use Notifiable;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
