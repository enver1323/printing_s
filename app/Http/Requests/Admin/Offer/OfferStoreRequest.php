<?php


namespace App\Http\Requests\Admin\Offer;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class OfferStoreRequest
 * @package App\Http\Requests\Admin\Offer
 *
 * @property array $name
 * @property array $description
 * @property integer $product_id
 * @property UploadedFile|null $photo
 */
class OfferStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'product_id' => 'required|numeric|exists:products,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
