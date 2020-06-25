<?php


namespace App\Http\Requests\Admin\Offer;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class OfferUpdateRequest
 * @package App\Http\Requests\Admin\Offer
 *
 * @property array $name
 * @property array $description
 * @property integer $product_id
 * @property UploadedFile|null $photo
 */
class OfferUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return isset($user) && $user->isAdmin();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'product_id' => 'required|numeric|exists:products,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
