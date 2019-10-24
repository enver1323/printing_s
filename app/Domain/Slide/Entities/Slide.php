<?php


namespace App\Domain\Slide\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;

/**
 * Class Line
 * @package App\Domain\Slide\Entities
 *
 * @property integer $id
 * @property string $description
 * @property string $link
 * @property integer $order
 */
class Slide extends Entity
{
    use Translatable, HasPhoto;

    public $timestamps = true;

    protected $dateFormat = 'U';

    protected $table = 'slides';

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['description'];
    }

    /**
     * @return array
     */
    protected function getPhotoSizes(): array
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getPhotoDirectoryPath(): string
    {
        return 'slides';
    }
}
