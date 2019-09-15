<?php


namespace App\Domain\Line\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Traits\Sluggable;
use App\Domain\Translation\Traits\Translatable;

/**
 * Class Line
 * @package App\Domain\Line\Entities
 *
 * @property integer $id
 * @property string $name
 */
class Line extends Entity
{
    use Translatable, Sluggable;

    protected $table = 'lines';

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name'];
    }

    /**
     * @return string
     */
    protected static function slugSource(): ?string
    {
        return 'name';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
