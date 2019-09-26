<?php


namespace App\Domain\Category\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\HasMeta;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;
use Carbon\Carbon;

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
class Category extends Entity
{
    use Translatable, Sluggable, HasMeta, HasPhoto;

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
}
