<?php


namespace App\Domain\_core\Meta;


/**
 * Trait HasMeta
 * @package App\Domain\_core\Meta
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property array $meta
 *
 * @mixin \Eloquent
 */
trait HasMeta
{
    /**
     * @param $value
     * @return array
     */
    public function getMetaAttribute($value): array
    {
        return json_decode($value) ?? [];
    }

    /**
     * @param $value
     */
    public function setMetaAttribute($value): void
    {
        $this->attributes['meta'] = json_encode($value);
    }
}
