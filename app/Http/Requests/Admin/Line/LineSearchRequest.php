<?php


namespace App\Http\Requests\Admin\Line;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LineSearchRequest
 * @package App\Http\Requests\Admin\Line
 *
 * @property integer $id
 * @property string $name
 */
class LineSearchRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:lines,id',
            'name' => 'nullable|string|max:255',
        ];
    }
}
