<?php


namespace App\Domain\_core\Traits;


use App\Domain\_core\Entity;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Support\Str;

/**
 * Trait Sluggable
 * @package App\Domain\_core\Traits
 *
 * @property string $slug
 *
 * @mixin Entity
 * @mixin Translatable
 */
trait Sluggable
{
    protected static function bootSluggable()
    {
        self::saving(function ($entity) {
            $entity->slug = $entity->generateSlug();
        });
    }

    /**
     * @return string
     */
    protected abstract static function slugSource(): ?string;

    /**
     * @return string
     */
    protected function generateSlug(): string
    {
        if (isset($this->slug))
            return $this->slug;

        $source = self::slugSource();
        $temp = $this->$source;

        if (method_exists($this, 'isTranslatable') && $this->isTranslatable($source))
            $temp = $this->getTranslations($source)['en'];

        $result = $temp;
        while ($this->where('slug', '=', $result)->count()) {
            $counter = isset($counter) ? $counter + 1 : 1;
            $result = sprintf("%s-%s", $temp, $counter);
        }

        return Str::slug($result, '-', 'en');
    }
}
