<?php

namespace App\Domain\User\Entities;

use App\Domain\_core\User\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 *
 * @property Profile $profile
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_VENDOR = 'vendor';

    public $timestamps = true;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public static function register(string $name, string $email, string $password): self
    {
        return self::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => Str::random(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_WAIT,
            'email_verified_at' => time() + 604800
        ]);
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isVendor(): bool
    {
        return $this->role === self::ROLE_VENDOR;
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

    public static function getByToken($token)
    {
        return self::where('verify_token', $token)->first();
    }

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [self::STATUS_ACTIVE, self::STATUS_WAIT];
    }

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_VENDOR];
    }

    /**
     * @throws \DomainException
     */
    public function verify(): void
    {
        if (!$this->isWait())
            throw new \DomainException(__('exceptionMessages.error.emailVerified'));

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * @return bool|null
     * @throws \Throwable
     */
    public function delete()
    {
        if($this->profile)
            $this->profile->delete();

        return parent::delete();
    }

    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    protected $dateFormat = 'U';
}
