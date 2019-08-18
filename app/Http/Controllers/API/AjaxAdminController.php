<?php


namespace App\Http\Controllers\API;


use App\Domain\Category\ReadRepositories\CategoryReadRepository;
use App\Domain\Country\ReadRepositories\CountryReadRepository;
use App\Domain\Country\ReadRepositories\RegionReadRepository;
use App\Http\Requests\Admin\Category\CategorySearchRequest;
use App\Http\Requests\Admin\Country\CountrySearchRequest;
use App\Http\Requests\Admin\Region\RegionSearchRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\Admin\Country\CountryResource;
use App\Http\Resources\Admin\Country\RegionResource;

class AjaxAdminController extends APIController
{
    const ITEMS_PER_PAGE = 8;

    /**
     * @param CountrySearchRequest $request
     * @return mixed
     */
    public function getCountries(CountrySearchRequest $request)
    {
        $countries = CountryReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(CountryResource::collection($countries));
    }

    /**
     * @param RegionSearchRequest $request
     * @return mixed
     */
    public function getRegions(RegionSearchRequest $request)
    {
        $regions = RegionReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(RegionResource::collection($regions));
    }

    public function getCategories(CategorySearchRequest $request)
    {
        $regions = CategoryReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(CategoryResource::collection($regions));
    }
}
