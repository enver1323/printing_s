<?php


namespace App\Entities\Brands;


use App\Entities\CustomModel;
use App\Entities\Translations\Entries\TranslationEntry;
use App\Entities\Images\Image;

/**
 * Class Brand
 * @package App\Entities\Brands
 *
 * @property integer $id
 * @property integer $name
 * @property integer $description
 * @property integer $image_id
 *
 * Relations:
 * @property TranslationEntry $nameEntry
 * @property TranslationEntry $descEntry
 * @property Image $image
 */
class Brand extends CustomModel
{
    protected $table = 'brands';

    public function nameEntries()
    {
        return parent::translationEntries('name');
    }

    public function descEntries()
    {
        return parent::translationEntries('description');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
