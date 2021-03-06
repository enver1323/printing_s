<?php


namespace App\Http\Controllers\Web;


use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Line\Entities\Line;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductGroup;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers\Web
 *
 * @property Category $categories
 * @property Product $products
 * @property Brand $brands
 * @property Line $lines
 */
class ProductController extends WebController
{
    private $categories;
    private $products;
    private $brands;
    private $lines;

    public function __construct(Brand $brands, Category $categories, Line $lines, Product $products)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->brands = $brands;
        $this->lines = $lines;
    }

    /**
     * @param Brand $brand
     * @return View
     */
    public function brandList(Brand $brand = null): View
    {
        return $this->render('brands.brandProductList', [
            'brand' => $brand,
            'brands' => $this->brands->all(),
            'lines' => $this->productList($brand)
        ]);
    }

    /**
     * @param Category|null $category
     * @return View
     */
    public function categoryList(Category $category = null): View
    {
        return $this->render('categories.categoryProductList', [
            'category' => $category,
            'categories' => $this->categories->all(),
            'lines' => $this->productList($category)
        ]);
    }

    /**
     * @param ProductGroup $item
     * @return LengthAwarePaginator
     */
    protected function productList(ProductGroup $item = null): LengthAwarePaginator
    {
        $products = isset($item) ? $item->products() : $this->products;
        $locale = app()->getLocale();

        /** @var LengthAwarePaginator|Collection $paginator */
        $paginator = $products
            ->whereNotNull("name->$locale")
            ->with('mainImage')
            ->withCount('offers')
            ->orderByDesc('updated_at')
            ->paginate(self::ITEMS_PER_PAGE);

        $products = $paginator->getCollection()->mapToGroups(function ($item) {
            return [$item->line_id => $item];
        });

        $lines = $this->lines->find($products->keys())->map(function ($value) use ($products) {
            $value->products = $products[$value->id];
            return $value;
        });

        $paginator->setCollection($lines);

        return $paginator;
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product->load('dataValues.dataKey', 'images', 'options', 'options.dataValues.dataKey');

        return $this->render('products.product', [
            'product' => $product
        ]);
    }
}
