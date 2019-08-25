<?php


namespace App\Domain\_core;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Entity
 * @package App\Domain\_core
 *
 * @mixin \Eloquent
 */
abstract class Entity extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
