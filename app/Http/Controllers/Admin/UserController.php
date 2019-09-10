<?php

namespace App\Http\Controllers\Admin;

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
 * @property User $users;
 */
class UserController extends AdminController
{
    private $service;
    private $users;

    public function __construct(UserService $service, User $users)
    {
        $this->service = $service;
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
            'roles' => $this->users::getRoles()
        ]);
    }

    public function create()
    {
        return $this->render('users.userCreate', [
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
     * @throws \Throwable
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->service->destroy($user->id);
            return redirect()->route('admin.users.index')->with('success', __('user.deleted_successfully'));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
