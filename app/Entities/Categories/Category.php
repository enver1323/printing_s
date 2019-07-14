<?php


namespace App\Entities\Categories;


use App\Entities\CustomModel;
use App\Entities\Translations\Entries\TranslationEntry;
use App\Entities\Images\Image;

/**
 * Class Category
 * @package App\Entities\Categories
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
class Category extends CustomModel
{
    protected $table = 'categories';

    public function nameEntry()
    {
        return $this->translationEntries('name');
    }

    public function descEntry()
    {
        return $this->translationEntries('description');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
