<?php


namespace App\Domain\Page\Entities;


use App\Domain\_core\Entity;

use App\Domain\_core\Traits\Sluggable;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class page
 * @package App\Domain\page\Entities
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $slug
 *
 * Relations
 * @property PageDocument[]|Collection $documents
 */
class Page extends Entity
{
    use Translatable, Sluggable;

    protected $table = 'pages';

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
        return ['name', 'content'];
    }

    /**
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(PageDocument::class, 'page_id', 'id');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
