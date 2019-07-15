<?php


namespace App\Entities\Slides;


use App\Entities\CustomModel;
use App\Entities\Images\Image;
use App\Entities\Products\Product;

/**
 * Class Slide
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
class Slide extends CustomModel
{
    protected $table = 'slides';

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
