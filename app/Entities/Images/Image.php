<?php


namespace App\Entities\Images;


use App\Entities\CustomModel;

/**
 * Class Image
 * @package App\Entities
 *
 * @property integer $id
 * @property string $path
 * @property string $name
 */
class Image extends CustomModel
{
    protected $table = 'images';
}
