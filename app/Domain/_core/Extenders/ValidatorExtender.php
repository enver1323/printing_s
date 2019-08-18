<?php


namespace App\Domain\_core\Extenders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;

/**
 * Class ValidatorExtender
 * @package App\Http\Requests\Validation
 */
class ValidatorExtender
{
    public static function extend(): void
    {
        ValidatorFacade::extend('keysExist', function ($attribute, $value, $parameters, $validator) {
            return self::keysExist($attribute, $value, $parameters, $validator);
        });
    }

    /**
     * Check if keys of array exists in database table
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param Validator $validator
     * @return bool
     */
    private static function keysExist($attribute, $value, $parameters, Validator $validator): bool
    {
        $values = array_keys($value);
        list($table, $column) = $parameters;

        $count = DB::table($table)->select($column)->whereIn($column, $values)->groupBy($column)->pluck($column)->count();

        return $count === sizeof($values);
    }
}
