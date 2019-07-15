<?php


namespace App\Entities\Products\Data_keys;


use App\Entities\CustomModel;
use App\Entities\Translations\Translation;

/**
 * Class ProductDataKey
 * @package App\Entites\Proucts\Data_keys
 *
 * @property integer $id
 * @property integer $name
 *
 * Relations:
 * @property Translation $translation
 */
class ProductDataKey extends CustomModel
{
    protected $table = 'product_data_keys';

    public function translation()
    {
        return parent::translation('name');
    }
}
