<?php


namespace App\Domain\Product\UseCases;


use App\Domain\_core\Service;
use App\Domain\Product\Entities\Facilities\DataKey;
use App\Domain\Product\Entities\Facilities\DataValue;
use App\Domain\Product\Entities\Facilities\HasFacilities;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\Facilities\ProductDataKeyReadRepository;
use App\Http\Requests\Admin\ProductData\ProductDataKeySearchRequest;
use App\Http\Requests\Admin\ProductData\ProductDataKeyStoreRequest;
use App\Http\Requests\Admin\ProductData\ProductDataKeyUpdateRequest;
use App\Http\Requests\Admin\ProductData\ProductDataValueUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductDataService
 * @package App\Domain\Product\UseCases
 *
 * @property DataKey $keys
 * @property DataValue $values
 * @property ProductDataKeyReadRepository $keyReadRepo
 */
class ProductDataService extends Service
{
    private $keys;
    private $values;
    private $keyReadRepo;

    /**
     * ProductDataService constructor.
     * @param DataKey $keys
     * @param DataValue $values
     * @param ProductDataKeyReadRepository $keyReadRepo
     */
    public function __construct(DataKey $keys, DataValue $values, ProductDataKeyReadRepository $keyReadRepo)
    {
        $this->keys = $keys;
        $this->values = $values;
        $this->keyReadRepo = $keyReadRepo;
    }

    /**
     * @param ProductDataKeySearchRequest $request
     * @return DataKey|Builder|null
     */
    public function searchKeys(ProductDataKeySearchRequest $request)
    {
        return $this->keyReadRepo->getSearchQuery($request->id, $request->name);
    }

    /**
     * @param ProductDataKeyStoreRequest $request
     * @return DataKey
     */
    public function storeKey(ProductDataKeyStoreRequest $request): DataKey
    {
        return $this->keys->create($request->validated());
    }

    /**
     * @param ProductDataKeyUpdateRequest $request
     * @param DataKey $key
     * @return DataKey
     */
    public function updateKey(ProductDataKeyUpdateRequest $request, DataKey $key): DataKey
    {
        $key->update($request->validated());
        return $key;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroyKey(int $id): bool
    {
        $key = $this->keys->findOrFail($id);
        return $key->delete();
    }

    /**
     * @param ProductDataValueUpdateRequest $request
     * @param HasFacilities $item
     */
    public function updateValues(ProductDataValueUpdateRequest $request, HasFacilities $item)
    {
        $values = collect($request->values);
        $values = $values->map(function($value, $key) {
            $value['data_key'] = $key;
            return $value;
        })->mapInto(DataValue::class);

        $item->dataValues()->delete();
        $item->dataValues()->saveMany($values);
    }
}
