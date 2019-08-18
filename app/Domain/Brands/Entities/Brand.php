<?php


namespace App\Domain\Brands\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\ManagesPhotos;
use App\Domain\_core\Photo\Photo;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Category\Entities\Category;
use App\Domain\Translation\Traits\Translatable;

/**
 * Class Brand
 * @package App\Domain\Brands\Entities
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property Photo $photo
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 */
class Brand extends Entity
{
    use Translatable, ManagesPhotos, Sluggable;
    public $timestamps = true;

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
        return "brands";
    }

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name', 'description'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return string
     */
    protected static function slugSource(): ?string
    {
        return 'name';
    }

    protected $dateFormat = 'U';

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
