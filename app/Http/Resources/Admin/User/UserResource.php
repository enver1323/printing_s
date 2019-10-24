<?php


namespace App\Http\Resources\Admin\User;


use App\Domain\User\Entities\User;
use App\Http\Resources\BaseJsonResource;
use Illuminate\Http\Request;

/**
 * Class UserResource
 * @package App\Http\Resources\Admin\User
 *
 * @mixin User
 */
class UserResource extends BaseJsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            self::ID => $this->id,
            self::NAME => $this->name,
            self::ROLE => $this->role,
            self::EMAIL => $this->email,
        ];
    }
}
