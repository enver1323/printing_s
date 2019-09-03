<?php


namespace App\Http\Controllers\API;


use App\Domain\Brand\ReadRepositories\BrandReadRepository;
use App\Domain\Category\ReadRepositories\CategoryReadRepository;
use App\Domain\Product\Repositories\ProductReadRepository;
use App\Domain\Translation\Repositories\LanguageReadRepository;
use App\Http\Requests\Admin\Brand\BrandSearchRequest;
use App\Http\Requests\Admin\Category\CategorySearchRequest;
use App\Http\Requests\Admin\Language\LanguageSearchRequest;
use App\Http\Requests\Admin\Product\ProductSearchRequest;
use App\Http\Resources\Admin\Brand\BrandResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\Admin\Language\LanguageResource;
use App\Http\Resources\Admin\Product\ProductResource;

class AjaxAdminController extends APIController
{
    const ITEMS_PER_PAGE = 8;

    /**
     * @param CategorySearchRequest $request
     * @return mixed
     */
    public function getCategories(CategorySearchRequest $request)
    {
        $regions = CategoryReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(CategoryResource::collection($regions));
    }

    /**
     * @param BrandSearchRequest $request
     * @return mixed
     */
    public function getBrands(BrandSearchRequest $request)
    {
        $brands = BrandReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(BrandResource::collection($brands));
    }

    /**
     * @param ProductSearchRequest $request
     * @return mixed
     */
    public function getProducts(ProductSearchRequest $request)
    {
        $products = ProductReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(ProductResource::collection($products));
    }

    /**
     * @param LanguageSearchRequest $request
     * @return mixed
     */
    public function getLanguages(LanguageSearchRequest $request)
    {
        $languages = LanguageReadRepository::getSearchQuery($request->code, $request->name)->get();

        return $this->render(LanguageResource::collection($languages));
    }
}
