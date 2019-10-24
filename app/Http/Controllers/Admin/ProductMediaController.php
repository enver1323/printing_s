<?php


namespace App\Http\Controllers\Admin;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductImage;
use App\Domain\Product\UseCases\ProductMediaService;
use App\Http\Requests\Admin\Product\ProductMediaUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class ProductMediaController
 * @package App\Http\Controllers\Admin
 */
class ProductMediaController extends AdminController
{
    private $service;

    public function __construct(ProductMediaService $service)
    {
        $this->service = $service;
    }


    /**
     * @param Product $product
     * @return View
     */
    public function mediaShow(Product $product): View
    {
        $product->load(['images']);
        return $this->render('products.media.productMedia', [
            'product' => $product
        ]);
    }

    /**
     * @param ProductMediaUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function mediaUpdate(ProductMediaUpdateRequest $request, Product $product): RedirectResponse
    {
        try {
            $this->service->updateMedia($request, $product);
            return redirect()->route('admin.products.media.show', $product)
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => __('adminPanel.media')]));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @param ProductImage $image
     * @return RedirectResponse
     */
    public function imageRight(Product $product, ProductImage $image): RedirectResponse
    {
        try {
            $this->service->movePhoto($product, $image, true);
            return redirect()->route('admin.products.media.show', $product)
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => __('adminPanel.media')]));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @param ProductImage $image
     * @return RedirectResponse
     */
    public function imageLeft(Product $product, ProductImage $image): RedirectResponse
    {
        try {
            $this->service->movePhoto($product, $image, false);
            return redirect()->route('admin.products.media.show', $product)
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => __('adminPanel.media')]));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @param ProductImage $image
     * @return RedirectResponse
     */
    public function imageDelete(Product $product, ProductImage $image): RedirectResponse
    {
        try {
            $this->service->deletePhoto($product, $image);
            return redirect()->route('admin.products.media.show', $product)
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => __('adminPanel.media')]));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
