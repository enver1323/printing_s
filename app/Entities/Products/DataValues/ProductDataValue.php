<?php


namespace App\Entities\Products\DataValues;


use App\Entities\CustomModel;
use App\Entities\Products\Product;
use App\Entities\Products\DataKeys\ProductDataKey;

/**
 * Class ProductDataValue
 * @package App\Entites\Products\Data_values
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $key_id
 * @property string $value
 *
 * Relations:
 * @property Product $product
 * @property ProductDataKey $productDataKey
 */
class ProductDataValue extends CustomModel
{
    protected $table = 'product_data_values';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productDataKey()
    {
        return $this->belongsTo(ProductDataKey::class, 'key_id', 'id');
    }
}
