<?php


namespace App\Http\Requests\Admin\Region;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionSearchRequest
 * @package App\Http\Requests\Admin\Region
 *
 * @property string $name
 * @property string $country
 * @property string $parent
 * @property string $slug
 */
class RegionSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:regions,id',
            'name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'parent' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
        ];
    }
}
