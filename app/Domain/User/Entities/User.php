<?php

namespace App\Domain\User\Entities;

use App\Domain\_core\User\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Domain\User\Entities
 * @mixin \Eloquent
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $status
 * @property string $verify_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role
 */
class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public $timestamps = true;

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @param $role
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function changeRole($role): void
    {
        if (!in_array($role, self::getRoles(), true)) {
            throw new \InvalidArgumentException(__('exceptionMessages.error.roleUndefined'), [
                'role' => $role
            ]);
        }
        if ($this->role === $role) {
            throw new \DomainException(__('exceptionMessages.error.roleAssigned'));
        }
        $this->update(['role' => $role]);
    }

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [self::ROLE_USER, self::ROLE_ADMIN];
    }
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    protected $dateFormat = 'U';
}
