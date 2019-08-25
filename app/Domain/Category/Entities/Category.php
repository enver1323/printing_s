<?php


namespace App\Domain\Category\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Traits\HasMeta;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Product\Entities\Facilities\DataKey;
use App\Domain\Translation\Traits\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 * @package App\Domain\Category\Entities
 *
 * @property integer $id
 * @property string $name
 * @property integer $_lft
 * @property integer $_rgt
 * @property integer $parent_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations:
 * @property Category $parent
 * @property Category[] $ancestors
 * @property Category[] $descendants
 * @property integer $depth
 * @property DataKey[]|Collection $dataKeys
 *
 * @method Builder descendantsWithDepth()
 */
class Category extends Entity
{
    use NodeTrait, Translatable, Sluggable, HasMeta;

    protected $table = 'categories';

    public $timestamps = true;

    protected $dateFormat = 'U';

    /**
     * @return mixed|string
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

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeDescendantsWithDepth(Builder $query): Builder
    {
        return $this->whereDescendantOf($this->id)->withDepth();
    }

    /**
     * @param bool $up
     * @param Collection|Builder $data
     * @return bool
     */
    public function isMovable(bool $up, $data = null): bool
    {
        $data = $data ?? $this;
        $data = $data->where('parent_id', '=', $this->parent_id);

        if($up)
            return $data->min('_lft') < $this->_lft;
        else
            return $data->max('_rgt') > $this->_rgt;
    }

    /**
     * @return HasMany
     */
    public function dataKeys(): HasMany
    {
        return $this->hasMany(DataKey::class, 'category_id', 'id');
    }
}
