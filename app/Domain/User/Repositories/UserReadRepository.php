<?php


namespace App\Domain\User\Repositories;


use App\Domain\_core\ReadRepository;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserReadRepository
 * @package App\Domain\User\Repositories
 *
 * @property User $users;
 */
class UserReadRepository extends ReadRepository
{
    /**
     * @param Builder|User $query
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $role
     * @return Builder|User
     */
    public static function getSearchQuery(int $id = null, string $name = null, string $email = null, string $role = null, $query = null)
    {
        $query = $query ?? new User();

        if (isset($id))
            $query = $query->whereKey('id');

        if (isset($name))
            $query = $query->where('name', 'like', "%$name%");

        if (isset($email))
            $query = $query->where('email', 'like', "%$email%");

        if (isset($role))
            $query = $query->where('role', '=', $role);

        return $query;
    }
}
