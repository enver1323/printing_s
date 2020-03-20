<?php


namespace App\Domain\Product\UseCases;


use App\Domain\_core\Service;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductReadRepository;
use App\Http\Requests\Admin\Product\ProductSearchRequest;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;

/**
 * Class ProductService
 * @package App\Domain\Product\UseCases
 *
 * @property Product $products
 * @property ProductReadRepository $productReadRepo
 */
class ProductService extends Service
{
    private $products;
    private $productReadRepo;

    /**
     * ProductService constructor.
     * @param Product $products
     * @param ProductReadRepository $productReadRepo
     */
    public function __construct(Product $products, ProductReadRepository $productReadRepo)
    {
        $this->products = $products;
        $this->productReadRepo = $productReadRepo;
    }

    /**
     * @param ProductSearchRequest $request
     * @return mixed
     */
    public function search(ProductSearchRequest $request)
    {
        return $this->productReadRepo->getSearchQuery($request->id, $request->name, $request->category_id, $request->brand_id);
    }

    /**
     * @param ProductStoreRequest $request
     * @return Product
     * @throws \Throwable
     */
    public function store(ProductStoreRequest $request): Product
    {
        $product = $this->products->create(array_merge($request->validated(), [
            'created_by' => $request->user()->id
        ]));

        return $product;
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return Product
     * @throws \Throwable
     */
    public function update(ProductUpdateRequest $request, Product $product): Product
    {
        $product->update($request->validated());
        return $product;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id): ?bool
    {
        $product = $this->products->find($id);

        return $product->delete();
    }
}
