<?php


namespace App\Entities\Videos;


use App\Entities\CustomModel;

/**
 * Class Video
 * @package App\Videos
 *
 * @property integer $id
 * @property string $path
 * @property string $name
 */
class Video extends CustomModel
{
    protected $table = 'videos';
}
