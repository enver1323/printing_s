<?php


namespace App\Domain\Product\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\HasMeta;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Product\Entities\Facilities\DataValue;
use App\Domain\Translation\Traits\Translatable;
use App\Domain\User\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * Class Product
 * @package App\Domain\Product\Entities
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $created_by
 * @property double $lat
 * @property double $lng
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property User $author
 * @property Category $category
 * @property Brand $brand
 * @property ProductOption[]|Collection $options
 * @property DataValue[]|Collection $dataValues
 */
class Product extends Entity
{
    use Translatable, Sluggable, HasPhoto, HasMeta;

    protected $table = 'products';
    public $timestamps = true;
    protected $dateFormat = 'U';

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
        return 'products';
    }

    /**
     * @return string
     */
    protected static function slugSource(): ?string
    {
        return 'name';
    }

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name', 'description'];
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class, 'product_id', 'id');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return MorphMany
     */
    public function dataValues(): MorphMany
    {
        return $this->morphMany(DataValue::class, 'owner');
    }
}
