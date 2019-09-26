<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Product\Entities\Facilities\DataKey;
use App\Domain\Product\UseCases\ProductDataService;
use App\Http\Requests\Admin\ProductData\ProductDataKeySearchRequest;
use App\Http\Requests\Admin\ProductData\ProductDataKeyStoreRequest;
use App\Http\Requests\Admin\ProductData\ProductDataKeyUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProductDataKeyController
 * @package App\Http\Controllers\Admin
 *
 * @property ProductDataService $service
 */
class ProductDataKeyController extends AdminController
{
    private $service;

    /**
     * ProductDataKeyController constructor.
     * @param ProductDataService $service
     */
    public function __construct(ProductDataService $service)
    {
        $this->service = $service;
    }

    public function index(ProductDataKeySearchRequest $request)
    {
        $keys = $this->service->searchKeys($request)
            ->paginate(self::ITEMS_PER_PAGE);

        return $this->render('products.data.keys.productDataKeyIndex', [
            'keys' => $keys->appends($request->input()),
        ]);
    }

    /** @return View */
    public function create(): View
    {
        return $this->render('products.data.keys.productDataKeyCreate');
    }

    /**
     * @param DataKey $key
     * @return View
     */
    public function show(DataKey $key): View
    {
        return $this->render('products.data.keys.productDataKeyShow', [
            'key' => $key
        ]);
    }

    /**
     * @param DataKey $key
     * @return View
     */
    public function edit(DataKey $key): View
    {
        return $this->render('products.data.keys.productDataKeyEdit', [
            'key' => $key
        ]);
    }

    /**
     * @param ProductDataKeyUpdateRequest $request
     * @param DataKey $key
     * @return RedirectResponse
     */
    public function update(ProductDataKeyUpdateRequest $request, DataKey $key): RedirectResponse
    {
        $this->service->updateKey($request, $key);
        return redirect()->route('admin.products.data.keys.show', $key)
            ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => __('adminPanel.dataKey')]));
    }

    /**
     * @param ProductDataKeyStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductDataKeyStoreRequest $request): RedirectResponse
    {
        $this->service->storeKey($request);
        return redirect()->route('admin.products.data.keys.index')
            ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => __('adminPanel.dataKey')]));
    }

    public function destroy(DataKey $key)
    {
        try {
            $this->service->destroyKey($key->id);
            return redirect()->route('admin.products.data.keys.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => __('adminPanel.dataKey')]));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.data.keys.index')
                ->with('error', $e->getMessage());
        }
    }
}
