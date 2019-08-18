<?php


namespace App\Domain\User\Repositories;


use App\Domain\User\Entities\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository
{

    /**
     * @param User $user
     * @throws \DomainException
     */
    public function save(User $user): void
    {
        if(!$user->save()){
            throw new \DomainException('User save error');
        }
    }
}
