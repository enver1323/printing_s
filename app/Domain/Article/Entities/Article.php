<?php


namespace App\Domain\Article\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\HasMeta;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Article
 * @package App\Domain\Article\Entities
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $created_by
 *
 * Relations:
 * @property User $author
 */
class Article extends Entity
{
    use Translatable, HasPhoto, Sluggable;

    protected $table = 'articles';

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
        return 'articles';
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
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return string
     */
    protected static function slugSource(): ?string
    {
        return 'name';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
