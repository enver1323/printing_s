<?php


namespace App\Http\Requests\Admin\Page;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageSearchRequest
 * @package App\Http\Requests\Admin\Page
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 */
class PageSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:pages,id',
            'name' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255',
        ];
    }
}
