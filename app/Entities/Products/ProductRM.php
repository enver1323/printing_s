<?php


namespace App\Entities\Products;


use App\Entities\Brands\Brand;
use App\Entities\CustomReadModel;
use App\Entities\Translations\Entries\TranslationEntry;
use App\Entities\Categories\Category;
use App\Entities\Lines\Line;
use App\Entities\Videos\Video;

/**
 * Class ProductRM
 * @package App\Entities\Products
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $line_id
 * @property integer $brand_id
 * @property integer $name
 * @property integer $description
 * @property string $type
 * @property integer $parent_id
 * @property integer $video_id
 * @property integer $created_at
 * @property integer $views
 *
 * Relations:
 * @property TranslationEntry $nameEntry
 * @property TranslationEntry $descEntry
 * @property Category $category
 * @property Line $line
 * @property Brand $brand
 * @property Product $product
 * @property Video $video
 */
class ProductRM extends Product implements CustomReadModel
{
    protected $table = 'products';

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
