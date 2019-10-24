<?php


namespace App\Http\Controllers\API;


use App\Domain\Brand\ReadRepositories\BrandReadRepository;
use App\Domain\Category\ReadRepositories\CategoryReadRepository;
use App\Domain\Line\ReadRepositories\LineReadRepository;
use App\Domain\Product\Repositories\Facilities\ProductDataKeyReadRepository;
use App\Domain\Product\Repositories\ProductReadRepository;
use App\Domain\User\Repositories\UserReadRepository;
use App\Http\Requests\Admin\Brand\BrandSearchRequest;
use App\Http\Requests\Admin\Category\CategorySearchRequest;
use App\Http\Requests\Admin\Line\LineSearchRequest;
use App\Http\Requests\Admin\Product\ProductSearchRequest;
use App\Http\Requests\Admin\ProductData\ProductDataKeySearchRequest;
use App\Http\Requests\Admin\User\UserSearchRequest;
use App\Http\Resources\Admin\Brand\BrandResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\Admin\Line\LineResource;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Http\Resources\Admin\ProductData\ProductDataKeyResource;
use App\Http\Resources\Admin\User\UserResource;

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
     * @param LineSearchRequest $request
     * @return mixed
     */
    public function getLines(LineSearchRequest $request)
    {
        $products = LineReadRepository::getSearchQuery(null, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(LineResource::collection($products));
    }

    /**
     * @param ProductDataKeySearchRequest $request
     * @return mixed
     */
    public function getDataKeys(ProductDataKeySearchRequest $request)
    {
        $keys = ProductDataKeyReadRepository::getSearchQuery($request->id, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(ProductDataKeyResource::collection($keys));
    }

    /**
     * @param UserSearchRequest $request
     * @return mixed
     */
    public function getUsers(UserSearchRequest $request)
    {
        $users = UserReadRepository::getSearchQuery($request->id, $request->name)
            ->take(self::ITEMS_PER_PAGE)
            ->get();

        return $this->render(UserResource::collection($users));
    }
}
