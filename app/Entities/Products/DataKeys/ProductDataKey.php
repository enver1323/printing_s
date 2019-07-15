<?php


namespace App\Entities\Products\DataKeys;


use App\Entities\CustomModel;
use Illuminate\Support\Collection;

/**
 * Class ProductDataKey
 * @package App\Entites\Proucts\Data_keys
 *
 * @property integer $id
 * @property integer $name
 *
 * Relations:
 * @property Collection $nameEntries
 */
class ProductDataKey extends CustomModel
{
    protected $table = 'product_data_keys';

    public function nameEntries()
    {
        return parent::translationEntries('name');
    }
}
