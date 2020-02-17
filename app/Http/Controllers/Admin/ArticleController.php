<?php


namespace App\Http\Controllers\Admin;

use App\Domain\Article\Entities\Article;
use App\Http\Requests\Admin\Article\ArticleSearchRequest;
use App\Http\Requests\Admin\Article\ArticleStoreRequest;
use App\Http\Requests\Admin\Article\ArticleUpdateRequest;
use App\Domain\Article\UseCases\ArticleService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 *
 * @property ArticleService $service
 */
class ArticleController extends AdminController
{
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ArticleSearchRequest $request
     * @return View
     */
    public function index(ArticleSearchRequest $request): View
    {
        $articles = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('articles.articleIndex', [
            'articles' => $articles->appends($request->input()),
        ]);
    }

    /**
     * @param Article|null $article
     * @return View
     */
    public function create(Article $article = null): View
    {
        return $this->render('articles.articleCreate', [
            'article' => $article,
        ]);
    }

    /**
     * @param ArticleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.articles.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Article']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        return $this->render('articles.articleShow', [
            'article' => $article,
        ]);
    }

    /**
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return $this->render('articles.articleEdit', [
            'article' => $article
        ]);
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(ArticleUpdateRequest $request, Article $article): RedirectResponse
    {
        try {
            return redirect()->route('admin.articles.show', $this->service->update($request, $article))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Article']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    /**
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        try {
            $this->service->destroy($article->id);
            return redirect()->route('admin.articles.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Article']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.articles.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     */
    public function deletePhoto(Article $article)
    {
        try {
            $article->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Article photo']));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
