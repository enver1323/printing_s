<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Brands\Entities\Brand;
use App\Domain\Brands\UseCases\BrandService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Brand\BrandSearchRequest;
use App\Http\Requests\Admin\Brand\BrandStoreRequest;
use App\Http\Requests\Admin\Brand\BrandUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class BrandController
 * @package App\Http\Controllers\Admin
 *
 * @property BrandService $service
 * @property Language $language
 */
class BrandController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(BrandService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param brandSearchRequest $request
     * @return View
     */
    public function index(BrandSearchRequest $request): View
    {

        $brands = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('brands.brandIndex', [
            'brands' => $brands->appends($request->input()),
        ]);
    }

    /**
     * @param Brand|null $brand
     * @return View
     */
    public function create(Brand $brand = null): View
    {
        return $this->render('brands.brandCreate', [
            'brand' => $brand,
            'languages' => $this->languages->all(),
        ]);
    }

    /**
     * @param BrandStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BrandStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.brands.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Brand']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Brand $brand
     * @return View
     */
    public function show(Brand $brand): View
    {
        return $this->render('brands.brandShow', [
            'brand' => $brand,
        ]);
    }

    /**
     * @param Brand $brand
     * @return View
     */
    public function edit(Brand $brand): View
    {
        return $this->render('brands.brandEdit', [
            'brand' => $brand,
            'languages' => $this->languages->all(),
        ]);
    }

    /**
     * @param BrandUpdateRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(BrandUpdateRequest $request, Brand $brand): RedirectResponse
    {
        try {
            return redirect()->route('admin.brands.show', $this->service->update($request, $brand))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Brand']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', $e->getMessage());
        }
    }


    /**
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            $this->service->destroy($brand->id);
            return redirect()->route('admin.categories.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'brand']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', $e->getMessage());
        }
    }

    public function deletePhoto(Brand $brand)
    {
        try {
            $brand->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Brand photo']));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
