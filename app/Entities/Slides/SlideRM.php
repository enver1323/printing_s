<?php


namespace App\Entities\Slides;

use App\Entities\CustomReadModel;
use App\Entities\Images\Image;
use App\Entities\Products\Product;

/**
 * Class SlideRM
 * @package App\Entities\Slides
 *
 * @property integer $id
 * @property integer $image_id
 * @property integer $product_id
 * @property string $url
 *
 * Relations:
 * @property Image $image
 * @property Product $product
 */

class SlideRM extends Slide implements CustomReadModel
{
    protected $table = 'news';

    protected $fillable = [];

    public function __get($key)
    {
        if($key === 'name')
            return $this->getTranslatedNameEntry();

        if($key === 'description')
            return $this->getTranslatedDescEntry();

        return parent::__get($key);
    }

    public function getById($id): self
    {
        return $this->findOrFail($id);
    }

    public function getAll(): ?Collection
    {
        return $this->all();
    }

    public function getPaginated(int $itemsPerPage)
    {
        return $this->paginate($itemsPerPage);
    }

    public function getTranslatedNameEntry(string $lang = null)
    {
        return $this->getEntry('name', $lang);
    }

    public function getTranslatedDescEntry(string $lang = null)
    {
        return $this->getEntry('description', $lang);
    }
}
