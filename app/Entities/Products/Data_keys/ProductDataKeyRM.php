<?php


namespace App\Entities\Products\Data_keys;


use App\Entities\CustomReadModel;
use App\Entities\Translations\Translation;

/**
 * Class ProductDataKeyRM
 * @package App\Entites\Proucts\Data_keys
 *
 * @property integer $id
 * @property integer $name
 *
 * Relations:
 * @property Translation $translation
 */
class ProductDataKeyRM extends ProductDataKey implements CustomReadModel
{
    protected $table = 'product_data_keys';

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
