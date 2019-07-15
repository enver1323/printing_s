<?php


namespace App\Entities\Products\Data_values;


use App\Entities\CustomModel;
use App\Entities\Products\Product;
use App\Entities\Products\Data_keys\ProductDataKey;

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
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function productDataKey()
    {
        return $this->hasOne(ProductDataKey::class, 'id', 'key_id');
    }
}
