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
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * @param Builder|User $query
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $status
     * @param string|null $role
     * @return Builder|User
     */
    public function getSearchQuery($query, int $id = null, string $name = null, string $email = null, string $status = null, string $role = null)
    {
        if (isset($id))
            $query = $query->whereKey('id');

        if (isset($name))
            $query = $query->where('name', 'like', "%$name%");

        if (isset($email))
            $query = $query->where('email', 'like', "%$email%");

        if (isset($status))
            $query = $query->where('status', '=', $status);

        if (isset($role))
            $query = $query->where('role', '=', $role);

        return $query;
    }
}
