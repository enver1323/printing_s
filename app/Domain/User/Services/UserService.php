<?php


namespace App\Domain\User\Services;


use App\Domain\_core\Service;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserReadRepository;
use App\Http\Requests\Admin\User\UserSearchRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserService
 * @package App\Services\Users
 *
 * @property User $users
 * @property UserReadRepository $userReadRepo
 */
class UserService extends Service
{
    private $users;
    private $userReadRepo;

    public function __construct(User $users, UserReadRepository $userReadRepo)
    {
        $this->users = $users;
        $this->userReadRepo = $userReadRepo;
    }

    /**
     * @param UserSearchRequest $request
     * @return Builder
     */
    public function search(UserSearchRequest $request): Builder
    {
        return $this->userReadRepo->getSearchQuery($this->users, $request->id, $request->name, $request->email, $request->role);
    }

    /**
     * @param UserStoreRequest $request
     * @return User
     */
    public function create(UserStoreRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        return $this->users->create($data);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return User
     */
    public function update(UserUpdateRequest $request, User $user): User
    {
        $data = $request->validated();
        $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->password;

        $user->update($data);
        return $user;
    }

    /**
     * @param User $user
     * @throws \Throwable
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }
}
