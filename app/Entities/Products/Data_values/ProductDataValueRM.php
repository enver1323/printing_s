<?php


namespace App\Entities\Products\Data_values;


use App\Entities\CustomReadModel;
use App\Entities\Products\Product;
use App\Entities\Products\Data_keys\ProductDataKey;

/**
 * Class ProductDataValueRM
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
class ProductDataValueRM extends ProductDataValue implements CustomReadModel
{
    protected $table = 'product_data_values';

    protected $fillable = [];

    public function getById($id)
    {
        return $this->findOrfail($id);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getPaginated(int $itemsPerPage)
    {
        return $this->paginate($itemsPerPage);
    }
}
