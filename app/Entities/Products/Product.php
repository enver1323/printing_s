<?php


namespace App\Entities\Products;


use App\Entities\Brands\Brand;
use App\Entities\CustomModel;
use App\Entities\Translations\Entries\TranslationEntry;
use App\Entities\Categories\Category;
use App\Entities\Lines\Line;
use App\Entities\Videos\Video;

/**
 * Class Product
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
class Product extends CustomModel
{
    protected $table = 'products';

    public function nameEntries()
    {
        return parent::translationEntries('name');
    }

    public function descEntries()
    {
        return parent::translationEntries('description');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function line()
    {
        return $this->hasOne(Line::class, 'id', 'line_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'parent_id');
    }

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
