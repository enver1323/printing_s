<?php


namespace App\Domain\Offer\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Product\Entities\Product;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Offer
 * @package App\Domain\Offer\Entities
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $description
 * @property string $photo
 */
class Offer extends Entity
{
    use HasPhoto, Translatable, Sluggable;

    protected $table = 'offers';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function getPhotoSizes(): array
    {
        return [];
    }

    protected function getPhotoDirectoryPath(): string
    {
        return 'offers';
    }

    protected function getTranslatable(): array
    {
        return ['name', 'description'];
    }


    protected static function slugSource(): ?string
    {
        return 'name';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
