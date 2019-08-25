<?php

namespace App\Domain\Country\Entities;

use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Country
 * @package App\Domain
 * @property int $id
 * @property int|string $name
 * @property string $slug
 * @property int $parent_id
 * @property int $phone_code
 * @property float $lat
 * @property float $lng
 * @property string $code
 *
 * Relations:
 * @property Region[]|Collection $regions
 */
class Country extends Entity
{
    use Translatable, HasPhoto, Sluggable;

    protected $table = 'countries';

    public $timestamps = false;

    /**
     * @param bool $all
     * @return HasMany
     */
    public function regions(bool $all = false): HasMany
    {
        $relation = $this->hasMany(Region::class, 'country_id', 'id');

        return $all ? $relation : $relation->whereNull('parent_id');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return array
     */
    protected function getPhotoSizes(): array
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getPhotoDirectoryPath(): string
    {
        return "countries/flags";
    }

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name'];
    }

    /**
     * @return string
     */
    protected static function slugSource(): ?string
    {
        return 'name';
    }
}
