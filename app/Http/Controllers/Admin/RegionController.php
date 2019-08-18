<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Country\Entities\Country;
use App\Domain\Country\Entities\Region;
use App\Domain\Country\UseCases\RegionService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Region\RegionStoreRequest;
use App\Http\Requests\Admin\Region\RegionUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class regionController
 * @package App\Http\Controllers\Admin
 *
 * @property Language $languages
 * @property RegionService $service
 */
class RegionController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(RegionService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param Country $country
     * @param Region|null $region
     * @return View
     */
    public function create(Country $country, Region $region = null)
    {
        return $this->render('regions.regionCreate', [
            'languages' => $this->languages->all(),
            'country' => $country,
            'region' => $region,
            'regions' => $country->regions(true)->get()
        ]);
    }

    /**
     * @param RegionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RegionStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.regions.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Region']));

        } catch (Exception | Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Region $region
     * @return View
     */
    public function show(Region $region): View
    {
        return $this->render('regions.regionShow', [
            'region' => $region->load('children')
        ]);
    }

    /**
     * @param Region $region
     * @return View
     */
    public function edit(Region $region): View
    {
        return $this->render('regions.regionEdit', [
            'region' => $region->load(['country', 'parent']),
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param RegionUpdateRequest $request
     * @param Region $region
     * @return RedirectResponse
     */
    public function update(RegionUpdateRequest $request, Region $region)
    {
        try {
            return redirect()->route('admin.regions.show', $this->service->update($region, $request))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Region']));
        } catch (Exception | Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Region $region
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Region $region): RedirectResponse
    {
        try {
            $this->service->destroy($region->id);
            return redirect()->route('admin.countries.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Region']));
        } catch (Exception | Throwable $e) {
            return redirect()->route('admin.countries.index')->with('error', $e->getMessage());
        }
    }
}
