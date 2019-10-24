<?php


namespace App\Domain\Product\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Photo\Photo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductImage
 * @package App\Domain\Product\Entities
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $order
 * @property Photo $photo
 *
 * Relations:
 * @property Product $product
 */
class ProductImage extends Entity
{
    use HasPhoto;

    protected $table = 'product_images';

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
        return "products/$this->product_id";
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
