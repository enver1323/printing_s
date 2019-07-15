<?php


namespace App\Entities\Products\DataValues;


use App\Entities\CustomReadModel;
use App\Entities\Products\Product;
use App\Entities\Products\DataKeys\ProductDataKey;

/**
 * Class ProductDataValueRM
 * @package App\Entites\Products\Data_values
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $key_id
 * @property string $name
 *
 * Relations:
 * @property Product $product
 * @property ProductDataKey $productDataKey
 */
class ProductDataValueRM extends ProductDataValue implements CustomReadModel
{
    protected $table = 'product_data_values';

    protected $fillable = [];

    public function __get($key)
    {
        if($key === 'name')
            return $this->getTranslatedNameEntry();

        return parent::__get($key);
    }

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

    public function getTranslatedNameEntry(string $lang = null): string
    {
        return $this->getEntry('name', $lang);
    }
}
