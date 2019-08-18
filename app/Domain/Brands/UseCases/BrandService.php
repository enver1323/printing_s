<?php


namespace App\Domain\Brands\UseCases;


use App\Domain\_core\Service;
use App\Domain\Brands\Entities\Brand;
use App\Domain\Brands\ReadRepositories\BrandReadRepository;
use App\Http\Requests\Admin\Brand\BrandSearchRequest;
use App\Http\Requests\Admin\Brand\BrandStoreRequest;
use App\Http\Requests\Admin\Brand\BrandUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class BrandService extends Service
{
    private $brandReadRepo;
    private $brands;

    public function __construct(Brand $brands, BrandReadRepository $brandReadRepo)
    {
        $this->brandReadRepo = $brandReadRepo;
        $this->brands = $brands;
    }

    /**
     * @param BrandSearchRequest $request
     * @return Builder
     */
    public function search(BrandSearchRequest $request): Builder
    {
        return $this->brandReadRepo->getSearchQuery($request->id, $request->name)
            ->orderByDesc('id');
    }

    /**
     * @param BrandStoreRequest $request
     * @return Brand
     * @throws Throwable
     */
    public function create(BrandStoreRequest $request): Brand
    {
        $brand = $this->brands->create($request->validated());
        $brand->updatePhoto($request->photo);
        return $brand;
    }

    /**
     * @param BrandUpdateRequest $request
     * @param Brand $brand
     * @return Brand
     * @throws Throwable
     */
    public function update(BrandUpdateRequest $request, Brand $brand): Brand
    {
        $brand->update($request->validated());

        $image = $request->file('photo');
        if (isset($image))
            $brand->updatePhoto($image);

        return $brand;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $brand = $this->brands->findOrfail($id);
        return $brand->delete();
    }
}
