<?php


namespace App\Domain\User\UseCases;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserReadRepository;
use App\Http\Requests\Admin\User\UserSearchRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Events\Dispatcher;

/**
 * Class UserService
 * @package App\Domain\User\UseCases
 * @property User $users
 * @property Dispatcher $dispatcher
 * @property UserReadRepository $userReadRepo
 */
class UserService
{
    private $users;
    private $dispatcher;
    private $userReadRepo;

    public function __construct(User $users, UserReadRepository $userReadRepo, Dispatcher $dispatcher)
    {
        $this->users = $users;
        $this->dispatcher = $dispatcher;
        $this->userReadRepo = $userReadRepo;
    }

    /**
     * @param UserSearchRequest $request
     * @return Builder
     */
    public function search(UserSearchRequest $request): Builder
    {
        $query = $this->userReadRepo->getSearchQuery($this->users, $request->id);

        return $query->orderBy('id', 'desc');
    }

    /**
     * @param UserStoreRequest $request
     * @return User
     * @throws Exception
     */
    public function create(UserStoreRequest $request): User
    {
        $userData = $request->except(['_token', 'password_confirmation']);
        $userData['password'] = bcrypt($userData['password']);

        return $this->users->create($userData);
    }

    /**
     * @param RegisterRequest $request
     * @return User
     */
    public function register(RegisterRequest $request): User
    {
        $user = $this->users->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $this->users::ROLE_USER,
        ]);

        $this->dispatcher->dispatch(new Registered($user));

        return $user;
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return User
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, User $user): User
    {
        $userData = $request->except(['_token', 'password_confirmation']);
        $userData['password'] = isset($userData['password']) ? bcrypt($userData['password']) : $user->password;

        $user->update($userData);

        return $user;
    }


    /**
     * @param int $id
     * @return bool|null
     * @throws Exception
     */
    public function destroy(int $id): ?bool
    {
        $user = $this->users->findOrFail($id);
        return $user->delete();
    }
}
