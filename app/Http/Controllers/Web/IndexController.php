<?php


namespace App\Http\Controllers\Web;


use App\Domain\Article\Entities\Article;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Comment\Entities\Comment;
use App\Domain\Line\Entities\Line;
use App\Domain\Page\Entities\Page;
use App\Domain\Product\Entities\Product;
use App\Domain\Slide\Entities\Slide;
use App\Http\Requests\Admin\Comment\CommentCreateRequest;
use App\Http\Requests\Frontend\Index\SearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class IndexController
 * @package App\Http\Controllers\Web
 *
 * @property Category $categories
 * @property Product $products
 * @property Article $articles
 * @property Comment $comments
 * @property Brand $brands
 * @property Slide $slides
 * @property Line $lines
 */
class IndexController extends WebController
{
    private $lines;
    private $slides;
    private $brands;
    private $comments;
    private $articles;
    private $products;
    private $categories;

    /**
     * IndexController constructor.
     * @param Category $categories
     * @param Brand $brands
     * @param Product $products
     * @param Line $lines
     * @param Slide $slides
     * @param Article $articles
     */
    public function __construct(Category $categories, Brand $brands, Product $products, Line $lines, Slide $slides, Article $articles, Comment $comments)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->articles = $articles;
        $this->comments = $comments;
        $this->brands = $brands;
        $this->slides = $slides;
        $this->lines = $lines;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categories->withCount('products')->orderByDesc('id')->take(4)->get();
        $articles = $this->articles->take(4)->get();
        $products = $this->products->take(6)->with('mainImage')->get();
        $brands = $this->brands->take(12)->get();
        $slides = $this->slides->get();

        return $this->render('index', [
            'categories' => $categories,
            'catCount' => $this->categories->whereNotIn('id', $categories->pluck('id'))->count(),
            'articles' => $articles,
            'products' => $products,
            'brands' => $brands,
            'slides' => $slides
        ]);
    }

    public function search(SearchRequest $request)
    {
        $productsPaginator = $this->products
            ->whereEntry('name', 'LIKE', "%$request->search%")
            ->orWhereEntry('description', 'LIKE', "%$request->search%")
            ->with('mainImage')
            ->paginate(self::ITEMS_PER_PAGE)
            ->appends($request->except('page'));

        $articles = $this->articles
            ->whereEntry('name', 'LIKE', "%$request->search%")
            ->orWhereEntry('description', 'LIKE', "%$request->search%")
            ->paginate(self::ITEMS_PER_PAGE)
            ->appends($request->except('page'));

        $products = $productsPaginator->getCollection()->mapToGroups(function ($item) {
            return [$item->line_id => $item];
        });

        $lines = $this->lines->find($products->keys())->map(function($value) use($products){
            $value->products = $products[$value->id];
            return $value;
        });

        $productsPaginator->setCollection($lines);

        return $this->render('_search', [
            'lines' => $productsPaginator,
            'articles' => $articles
        ]);
    }

    public function contacts(): View
    {
        return $this->render('contacts.contacts');
    }

    /**
     * @param CommentCreateRequest $request
     * @return RedirectResponse
     */
    public function createComment(CommentCreateRequest $request): RedirectResponse
    {
        $this->comments->create($request->validated());
        return redirect()->back();
    }
}
