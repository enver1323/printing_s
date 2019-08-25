<?php


namespace App\Http\Controllers\Admin;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\UseCases\ProductService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Product\ProductSearchRequest;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 *
 * @property ProductService $service
 * @property Language $languages
 */
class ProductController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(ProductService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param ProductSearchRequest $request
     * @return View
     */
    public function index(ProductSearchRequest $request): View
    {
        $products = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('products.productIndex', [
            'products' => $products->appends($request->input()),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return $this->render('products.productCreate',[
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.products.show', $this->service->store($request)->load([
                'category', 'options', 'brand', 'author'
            ]))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return $this->render('products.productShow', [
            'product' => $product
        ]);
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return $this->render('products.productEdit', [
            'product' => $product,
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        try {
            return redirect()->route('admin.products.show', $this->service->update($request, $product))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.index')->with('error', $e->getMessage());
        }
    }


    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        try {
            $this->service->destroy($product->id);
            return redirect()->route('admin.products.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function deletePhoto(Product $product)
    {
        try {
            $product->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Item photo']));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
