<?php


namespace App\Domain\User\UseCases;

use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserReadRepository;
use App\Http\Requests\Admin\User\UserSearchRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Domain\User\UseCases
 * @property User $users
 * @property Mailer $mailer
 * @property Profile $profiles
 * @property Dispatcher $dispatcher
 * @property UserReadRepository $userReadRepo
 */
class UserService
{
    private $users;
    private $mailer;
    private $profiles;
    private $dispatcher;
    private $userReadRepo;

    public function __construct(User $users, UserReadRepository $userReadRepo, Profile $profiles, Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->users = $users;
        $this->mailer = $mailer;
        $this->profiles = $profiles;
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
        $userData = $request->except(['_token', 'profile', 'password_confirmation']);
        $userData['password'] = bcrypt($userData['password']);

        $profileData = $request->get('profile');
        $profileData['birth_date'] = $this->parseBirthDate($profileData['birth_date']);

        $user = new $this->users($userData);
        $profile = new $this->profiles($profileData);

        $this->saveData($user, $profile);

        if ($profile->photo = $request->file('profile.photo'))
            $profile->saveOrFail();

        return $user;
    }

    /**
     * @param RegisterRequest $request
     * @return User
     */
    public function register(RegisterRequest $request): User
    {
        $user = $this->users::register($request->get('name'), $request->get('email'), $request->get('password'));

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));

        return $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function verify(int $id): User
    {
        $user = $this->users::findOrFail($id);
        $user->verify();

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
        $userData = $request->except(['_token', 'profile', 'password_confirmation']);
        $userData['password'] = isset($userData['password']) ? bcrypt($userData['password']) : $user->password;

        $profileData = $request->get('profile');
        $profileData['birth_date'] = $this->parseBirthDate($profileData['birth_date']);

        $user = $user->fill($userData);
        $profile = $user->profile->fill($profileData);

        $this->saveData($user, $profile);

        $image = $request->file('profile.photo');
        if (isset($image))
            $profile->updatePhoto($image);

        return $user;
    }

    /**
     * @param User $user
     * @throws \Throwable
     */
    public function destroy(User $user): void
    {
        if ($user->profile()->exists())
            $user->profile->delete();

        $user->delete();
    }

    /**
     * @param string $date
     * @return string|null
     */
    protected function parseBirthDate(string $date = null): ?string
    {
        return isset($date) ? strtotime($date) : null;
    }

    /**
     * @param User $user
     * @param Profile $profile
     * @throws Exception
     */
    protected function saveData(User $user, Profile $profile)
    {
        DB::beginTransaction();

        try {
            $user->save();
            $user->profile()->save($profile);
        } catch (Exception $exception) {
            DB::rollback();
            throw $exception;
        }

        DB::commit();
    }
}
