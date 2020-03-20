<?php


namespace App\Domain\Product\UseCases;


use App\Domain\_core\Service;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use App\Domain\Product\Repositories\ProductOptionReadRepository;
use App\Http\Requests\Admin\ProductOption\ProductOptionStoreRequest;
use App\Http\Requests\Admin\ProductOption\ProductOptionUpdateRequest;

/**
 * Class ProductOptionService
 * @package App\Domain\Product\UseCases
 *
 * @property ProductOption $options
 * @property ProductOptionReadRepository $optionReadRepo
 */
class ProductOptionService extends Service
{
    private $options;
    private $optionReadRepo;

    /**
     * ProductOptionService constructor.
     * @param ProductOption $options
     * @param ProductOptionReadRepository $optionReadRepo
     */
    public function __construct(ProductOption $options, ProductOptionReadRepository $optionReadRepo)
    {
        $this->options = $options;
        $this->optionReadRepo = $optionReadRepo;
    }

    /**
     * @param ProductOptionStoreRequest $request
     * @return mixed
     */
    public function store(ProductOptionStoreRequest $request)
    {
        return $this->options->create(array_merge($request->validated(), [
            'created_by' => $request->user()->id
        ]));
    }

    /**
     * @param ProductOptionUpdateRequest $request
     * @param ProductOption $option
     * @return ProductOption
     */
    public function update(ProductoptionUpdateRequest $request, ProductOption $option): ProductOption
    {
        $option->update($request->validated());

        return $option;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id): ?bool
    {
        $option = $this->options->find($id);

        return $option->delete();
    }
}
