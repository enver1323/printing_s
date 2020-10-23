<?php


namespace App\Http\Controllers\Web;


use App\Domain\Article\Entities\Article;
use Illuminate\View\View;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Web
 *
 * @property Article $articles
 */
class ArticleController extends WebController
{
    private $articles;

    public function __construct(Article $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $articles = $this->articles->orderByDesc('updated_at')->paginate(self::ITEMS_PER_PAGE);
        return $this->render('articles.articleList', [
            'articles' => $articles
        ]);
    }

    /**
     * @param Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        return $this->render('articles.article', [
            'article' => $article
        ]);
    }
}
