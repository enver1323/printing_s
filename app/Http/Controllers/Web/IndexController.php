<?php


namespace App\Http\Controllers\Web;


use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Product\Entities\Product;
use Illuminate\View\View;

/**
 * Class IndexController
 * @package App\Http\Controllers\Web
 *
 * @property Category $categories
 * @property Product $products
 * @property Brand $brands
 */
class IndexController extends WebController
{
    private $brands;
    private $products;
    private $categories;

    /**
     * IndexController constructor.
     * @param Category $categories
     * @param Brand $brands
     * @param Product $products
     */
    public function __construct(Category $categories, Brand $brands, Product $products)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->brands = $brands;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categories->take(4)->get();
        $products = $this->products->take(6)->with('mainImage')->get();
        $brands = $this->brands->take(12)->get();

        return $this->render('index', [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
        ]);
    }
}
