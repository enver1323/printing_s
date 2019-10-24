<?php


namespace App\Http\Controllers\Web;


use App\Domain\Article\Entities\Article;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Product\Entities\Product;
use App\Domain\Slide\Entities\Slide;
use Illuminate\View\View;

/**
 * Class IndexController
 * @package App\Http\Controllers\Web
 *
 * @property Category $categories
 * @property Product $products
 * @property Article $articles
 * @property Brand $brands
 * @property Slide $slides
 */
class IndexController extends WebController
{
    private $slides;
    private $brands;
    private $articles;
    private $products;
    private $categories;

    /**
     * IndexController constructor.
     * @param Category $categories
     * @param Brand $brands
     * @param Product $products
     * @param Slide $slides
     * @param Article $articles
     */
    public function __construct(Category $categories, Brand $brands, Product $products, Slide $slides, Article $articles)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->articles = $articles;
        $this->brands = $brands;
        $this->slides = $slides;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categories->withCount('products')->take(4)->get();
        $articles = $this->articles->take(4)->get();
        $products = $this->products->take(6)->with('mainImage')->get();
        $brands = $this->brands->take(12)->get();
        $slides = $this->slides->get();

        return $this->render('index', [
            'categories' => $categories,
            'articles' => $articles,
            'products' => $products,
            'brands' => $brands,
            'slides' => $slides
        ]);
    }

    public function contacts(): View
    {
        return $this->render('contacts.contacts');
    }
}
