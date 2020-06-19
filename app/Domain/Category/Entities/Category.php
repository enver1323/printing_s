<?php


namespace App\Domain\Category\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\HasMeta;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductGroup;
use App\Domain\Translation\Traits\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 */
class Category extends Entity implements ProductGroup
{
    use Translatable, Sluggable, HasPhoto;

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
        return "categories";
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getShortDescriptionAttribute(int $length = null): ?string
    {
        $length = $length ?? 258;
        if (strlen($this->description) >= $length)
            return substr($this->description, 0, $length) . " ... ";

        return $this->description;
    }
}
