<?php


namespace App\Entities\Lines;


use App\Entities\CustomModel;
use App\Entities\Translations\Entries\TranslationEntry;

/**
 * Class Line
 * @package App\Entities\Lines
 *
 * @property integer $id
 * @property integer $name
 *
 * Relations:
 * @property TranslationEntry $nameEntry
 */
class Line extends CustomModel
{
    protected $table = 'lines';


}
