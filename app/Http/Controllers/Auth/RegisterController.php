<?php

namespace App\Http\Controllers\Auth;

use App\Domain\User\Entities\User;
use App\Domain\User\UseCases\UserService;
use App\Http\Controllers\Web\WebController;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 * @property UserService $service
 */
class RegisterController extends WebController
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register', $this->modifyParams([]));
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->service->register($request);
            $this->setResponseMessage(
                'success',
                __('exceptionMessages.success.emailVerify', ['name', $user->name])
            );
        } catch (\Exception $e) {
            $this->setResponseMessage(
                'error',
                $e->getMessage()
            );
        }
        return redirect()->route('login');
    }


    public function verify($token)
    {

        try {
            if(!$user = User::getByToken($token))
                throw new NotFoundHttpException(__('exceptionMessages.error.userNF'));

            $this->service->verify($user->id);
            $this->setResponseMessage(
                'success',
                __('exceptionMessages.success.emailVerified')
            );
        } catch (\Exception $e) {
            $this->setResponseMessage(
                'error',
                $e->getMessage()
            );
        }
        return redirect()->route('login');
    }


    private function setResponseMessage($status, $message)
    {
        session()->flash($status, $message);
    }
}
