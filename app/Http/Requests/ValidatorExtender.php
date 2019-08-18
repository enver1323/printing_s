<?php


namespace App\Http\Requests;


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
        ValidatorFacade::extend('keysExist', function($attribute, $value, $parameters, $validator){
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
        $verifier = $validator->getPresenceVerifier();

        list($table, $column) = $parameters;

        return (bool)($verifier->getMultiCount($table, $column, $values) >= 1);
    }
}
