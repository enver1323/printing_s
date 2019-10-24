<?php


namespace App\Domain\Product\UseCases;


use App\Domain\_core\Service;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductImage;
use App\Http\Requests\Admin\Product\ProductMediaUpdateRequest;
use Illuminate\Support\Collection;

class ProductMediaService extends Service
{
    /**
     * @param ProductMediaUpdateRequest $request
     * @param Product $product
     * @throws \Throwable
     */
    public function updateMedia(ProductMediaUpdateRequest $request, Product $product)
    {
        if ($request->photos)
            $this->setPhotos(collect()->wrap($request->photos), $product);
    }

    /**
     * @param Collection $photos
     * @param Product $product
     * @return Collection
     * @throws \Throwable
     */
    public function setPhotos(Collection $photos, Product $product): Collection
    {
        $order = $product->images()->count() + 1;
        $images = collect();

        $photos = $photos->map(function ($value, $key) use (&$images, &$order) {
            $images->push(['order' => $order++]);
            return $value;
        });

        /** @var ProductImage[]|Collection $images */
        $images = $product->images()->createMany($images->toArray());

        foreach ($photos as $i => $photo)
            $images[$i]->updatePhoto($photo);

        return $images;
    }

    /**
     * @param Product $product
     * @param ProductImage $image
     * @param bool $toRight
     */
    public function movePhoto(Product $product, ProductImage $image, bool $toRight = true): void
    {
        $images = $product->images;
        $oldOrder = $image->order;
        $image->order = $toRight ? $image->order + 1 : $image->order - 1;

        $subImage = $images->where('order', '=', $image->order)->first();
        $subImage->order = $oldOrder;

        $product->images()->saveMany([$image, $subImage]);
    }

    /**
     * @param Product $product
     * @param ProductImage $image
     * @return bool
     * @throws \Exception
     */
    public function deletePhoto(Product $product, ProductImage $image): bool
    {
        $images = $product->images;
        $images = $images->where('order', '>', $image->order)->map(function($item){
            $item->order--;
            return $item;
        });

        $product->images()->saveMany($images);

        return $image->delete();
    }
}
