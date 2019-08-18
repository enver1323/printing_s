<?php

namespace App\Domain\User\Entities;

use App\Domain\_core\Entity;
use App\Domain\_core\Photo\Photo;
use App\Domain\_core\Photo\ManagesPhotos;
use App\Domain\Country\Entities\Country;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Profile
 * @package App\Domain\User\Entities
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $family_name
 * @property integer $birth_date
 * @property Photo $photo
 * @property string $nickname
 * @property string $gender
 *
 * @property User $user
 * @property Country $country
 */
class Profile extends Entity
{
    use ManagesPhotos;

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    protected $touches = ['user'];
    protected $table = 'profiles';
    protected $dateFormat = 'U';
    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * @return array
     */
    public static function getGenders(): array
    {
        return [self::GENDER_MALE, self::GENDER_FEMALE];
    }

    public function getPhotoSizes(): array
    {
        return [
            'search' => [
                'width' => 500,
                'height' => null,
                'methods' => [
                    'fit' => -1,
                    'resize' => -1,
                    'blur' => 50
                ]
            ],
            'admin' => [
                'width' => 500,
                'height' => null,
                'methods' => [
                    'fit' => -1,
                    'resize' => -1,
                    'blur' => 50
                ]
            ]
        ];
    }

    protected function getPhotoDirectoryPath(): string
    {
        return "profiles";
    }
}
