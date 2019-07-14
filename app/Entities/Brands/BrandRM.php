<?php


namespace App\Entities\Brands;


use App\Entities\CustomReadModel;
use App\Entities\Images\Image;
use App\Entities\Translations\Entries\TranslationEntry;
use Illuminate\Support\Collection;

/**
 * Class Brand
 * @package App\Entities\Brands
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $image_id
 *
 * Relations:
 * @property TranslationEntry $nameEntry
 * @property TranslationEntry $descEntry
 * @property Image $image
 */
class BrandRM extends Brand implements CustomReadModel
{
    protected $table = 'brands';

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
