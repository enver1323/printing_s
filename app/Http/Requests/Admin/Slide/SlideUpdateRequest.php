<?php


namespace App\Http\Requests\Admin\Slide;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class SlideStoreRequest
 * @package App\Http\Requests\Admin\Slide
 *
 * @property integer $order
 * @property UploadedFile $photo
 * @property array $description
 * @property string $link
 */
class SlideUpdateRequest extends FormRequest
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
            'order' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'link' => 'required|string',
            'video' => 'nullable:photo|string',
        ];
    }
}
