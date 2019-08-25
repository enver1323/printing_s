<?php


namespace App\Domain\Country\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Region
 * @package App\Domain\Country\Entities
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 * @property string $slug
 * @property integer|null $parent_id
 * @property float $lat
 * @property float $lng
 *
 * Relations:
 * @property Country $country
 * @property Region $parent
 * @property Region[]|Collection $children
 */
class Region extends Entity
{
    use Translatable, Sluggable;

    protected $table = 'regions';

    protected $touches = ['country'];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
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
