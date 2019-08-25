<?php


namespace App\Domain\_core\Extenders;


interface Extender
{
    /**
     * Registers extenders, macros and morphs
     */
    public static function extend(): void;
}
