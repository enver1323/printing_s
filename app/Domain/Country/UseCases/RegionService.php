<?php


namespace App\Domain\Country\UseCases;


use App\Domain\Country\Entities\Region;
use App\Http\Requests\Admin\Region\RegionStoreRequest;
use App\Http\Requests\Admin\Region\RegionUpdateRequest;

/**
 * Class CountryService
 * @package App\Domain\Country\UseCases
 *
 * @property Region $regions
 */
class RegionService
{
    private $regions;

    public function __construct(Region $regions)
    {
        $this->regions = $regions;
    }

    /**
     * @param RegionStoreRequest $request
     * @return Region
     */
    public function create(RegionStoreRequest $request): Region
    {
        return $this->regions->create($request->validated());
    }

    /**
     * @param Region $region
     * @param RegionUpdateRequest $request
     * @return Region
     */
    public function update(Region $region, RegionUpdateRequest $request): Region
    {
        $region->update($request->validated());

        return $region;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id): ?bool
    {
        $region = $this->regions->findOrFail($id);

        return $region->delete();
    }
}
