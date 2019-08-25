<?php


namespace App\Domain\_core\Extenders;


use Illuminate\Support\Collection;

/**
 * Class CollectionExtender
 * @package App\Domain\_core\Extenders
 */
class CollectionExtender
{
    /**
     * Registers extenders, macros and morphs
     */
    public static function extend()
    {
        self::consistOnlyOf();
    }

    private static function consistOnlyOf()
    {
        Collection::macro('consistOnlyOf', function (string $class) {
            /** @mixin Collection */
            return $this->containsStrict(function ($key, $value) use ($class) {
                return $value instanceof $class;
            });
        });
    }
}
