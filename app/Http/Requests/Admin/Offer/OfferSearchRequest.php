<?php


namespace App\Http\Requests\Admin\Offer;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OfferSearchRequest
 * @package App\Http\Requests\Admin\Offer
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $product
 */
class OfferSearchRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->isAdmin();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:Offers,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'product' => 'nullable|numeric|exists:products,id'
        ];
    }
}
