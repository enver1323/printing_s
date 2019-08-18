<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Country\Entities\Country;
use App\Domain\Country\UseCases\CountryService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Country\CountrySearchRequest;
use App\Http\Requests\Admin\Country\CountryStoreRequest;
use App\Http\Requests\Admin\Country\CountryUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class CountryController
 * @package App\Http\Controllers\Admin
 *
 * @property Language $languages
 * @property CountryService $service
 */
class CountryController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(CountryService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param CountrySearchRequest $request
     * @return View
     */
    public function index(CountrySearchRequest $request): View
    {
        $countries = $this->service->search($request)
            ->withCount('regions')
            ->paginate(self::ITEMS_PER_PAGE);

        return $this->render('countries.countryIndex', [
            'countries' => $countries->appends($request->input())
        ]);
    }

    /**
     * @return View
     */
    public function create()
    {
        return $this->render('countries.countryCreate', [
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param CountryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CountryStoreRequest $request)
    {
        try {
            return redirect()->route('admin.countries.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Country']));

        } catch (Exception | Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Country $country
     * @return View
     */
    public function show(Country $country): View
    {
        return $this->render('countries.countryShow', [
            'country' => $country->load('regions')
        ]);
    }

    /**
     * @param Country $country
     * @return View
     */
    public function edit(Country $country): View
    {
        return $this->render('countries.countryEdit', [
            'country' => $country,
            'languages' => $this->languages->all()
        ]);
    }

    /**
     * @param CountryUpdateRequest $request
     * @param Country $country
     * @return RedirectResponse
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        try {
            return redirect()->route('admin.countries.show', $this->service->update($country, $request))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Country']));
        } catch (Exception | Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Country $country
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Country $country): RedirectResponse
    {
        try {
            $this->service->destroy($country->id);
            return redirect()->route('admin.countries.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Country']));
        } catch (Exception | Throwable $e) {
            return redirect()->route('admin.countries.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Country $country
     * @return RedirectResponse
     */
    public function deletePhoto(Country $country): RedirectResponse
    {
        try {
            $country->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Country photo']));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
