<?php

namespace App\Http\Controllers\Admin;

use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use App\Domain\User\UseCases\UserService;
use App\Http\Requests\Admin\User\UserSearchRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 * @property UserService $service;
 * @property Profile $profiles;
 * @property User $users;
 */
class UserController extends AdminController
{
    private $service;
    private $users;
    private $profiles;

    public function __construct(UserService $service, User $users, Profile $profiles)
    {
        $this->service = $service;
        $this->profiles = $profiles;
        $this->users = $users;
    }

    /**
     * @param UserSearchRequest $request
     * @return View
     */
    public function index(UserSearchRequest $request): View
    {
        $users = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('users.userIndex', [
            'users' => $users->appends($request->input()),
            'statuses' => $this->users::getStatuses(),
            'roles' => $this->users::getRoles()
        ]);
    }

    public function create()
    {
        return $this->render('users.userCreate', [
            'genders' => $this->profiles->getGenders(),
            'statuses' => $this->users::getStatuses(),
            'roles' => $this->users::getRoles()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->service->create($request);
            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return $this->render('users.userShow', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return $this->render('users.userEdit', [
            'user' => $user,
            'genders' => $this->profiles->getGenders(),
            'statuses' => $this->users::getStatuses(),
            'roles' => $this->users::getRoles()
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $user = $this->service->update($request, $user);
            return redirect()->route('admin.users.show', $user);
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function verify(User $user): RedirectResponse
    {
        $this->service->verify($user->id);
        return redirect()->route('admin.users.show', $user)->with('success', __('user.verified_successfully'));
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->service->destroy($user);
            return redirect()->route('admin.users.index')->with('success', __('user.deleted_successfully'));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Profile $profile
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function deleteProfilePhoto(Profile $profile): RedirectResponse
    {
        try {
            $profile->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Profile photo']));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
