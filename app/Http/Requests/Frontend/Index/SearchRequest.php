<?php


namespace App\Http\Requests\Frontend\Index;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Frontend\Index
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property string $search
 */
class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'string|nullable|max:255'
        ];
    }
}
