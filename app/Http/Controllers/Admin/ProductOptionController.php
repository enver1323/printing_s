<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use App\Domain\Product\UseCases\ProductDataService;
use App\Domain\Product\UseCases\ProductOptionService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\ProductData\ProductDataValueUpdateRequest;
use App\Http\Requests\Admin\ProductOption\ProductOptionStoreRequest;
use App\Http\Requests\Admin\ProductOption\ProductOptionUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class ProductOptionController
 * @package App\Http\Controllers\Admin
 *
 * @property ProductOptionService $service
 * @property Language $languages
 */
class ProductOptionController extends AdminController
{
    private $service;
    private $languages;
    private $dataService;

    public function __construct(ProductOptionService $service, Language $languages, ProductDataService $dataService)
    {
        $this->service = $service;
        $this->languages = $languages;
        $this->dataService = $dataService;
    }

    /**
     * @param Product $product
     * @return View
     */
    public function create(Product $product): View
    {
        return $this->render('products.options.productOptionCreate',[
            'languages' => $this->languages->all(),
            'product' => $product
        ]);
    }

    /**
     * @param ProductOptionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductOptionStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.products.options.show', $this->service->store($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Option']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param ProductOption $option
     * @return View
     */
    public function show(ProductOption $option): View
    {
        return $this->render('products.options.productOptionShow', [
            'option' => $option
        ]);
    }

    /**
     * @param ProductOption $option
     * @return View
     */
    public function edit(ProductOption $option): View
    {
        return $this->render('products.options.productOptionEdit', [
            'option' => $option,
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param ProductOptionUpdateRequest $request
     * @param ProductOption $option
     * @return RedirectResponse
     */
    public function update(ProductOptionUpdateRequest $request, ProductOption $option): RedirectResponse
    {
        try {
            return redirect()->route('admin.products.options.show', $this->service->update($request, $option))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Option']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.options.index')->with('error', $e->getMessage());
        }
    }


    /**
     * @param ProductOption $option
     * @return RedirectResponse
     */
    public function destroy(ProductOption $option): RedirectResponse
    {
        try {
            $this->service->destroy($option->id);
            return redirect()->route('admin.products.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Option']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.products.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param ProductOption $option
     * @return View
     */
    public function showValues(ProductOption $option): View
    {
        $values = $option->dataValues()
            ->with('dataKey')->get()
            ->map(function($value){
                $value->dataKey->name;
                return $value;
            });
        return $this->render('products.data.values.productDataValueShow', [
            'item' => $option,
            'values' => $values,
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param ProductDataValueUpdateRequest $request
     * @param ProductOption $option
     * @return RedirectResponse
     */
    public function updateValues(ProductDataValueUpdateRequest $request, ProductOption $option): RedirectResponse
    {
        $this->dataService->updateValues($request, $option);
        return redirect()->route('admin.products.options.data.values.show', $option)
            ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Option']));
    }
}
