<?php


namespace App\Domain\User\UseCases;


use App\Domain\_core\Service;
use App\Domain\User\Entities\Profile;

/**
 * Class ProfileService
 * @package App\Domain\User\UseCases
 *
 * @property Profile $profiles
 */
class ProfileService extends Service
{
    private $profiles;

    public function __construct(Profile $profiles)
    {
        $this->profiles = $profiles;
    }
}
