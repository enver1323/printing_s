<?php


namespace App\Domain\Article\UseCases;


use App\Domain\_core\Service;
use App\Domain\Article\ReadRepositories\ArticleReadRepository;
use App\Domain\Article\Entities\Article;
use App\Http\Requests\Admin\Article\ArticleSearchRequest;
use App\Http\Requests\Admin\Article\ArticleStoreRequest;
use App\Http\Requests\Admin\Article\ArticleUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * Class ArticleService
 * @package App\Domain\Article\UseCases
 *
 * @property ArticleReadRepository $articleReadRepo
 * @property Article $articles
 */
class ArticleService extends Service
{
    private $articleReadRepo;
    private $articles;

    public function __construct(Article $articles, ArticleReadRepository $articleReadRepo)
    {
        $this->articleReadRepo = $articleReadRepo;
        $this->articles = $articles;
    }

    /**
     * @param ArticleSearchRequest $request
     * @return Builder
     */
    public function search(ArticleSearchRequest $request): Builder
    {
        return $this->articleReadRepo->getSearchQuery($request->id, $request->name, $request->description, $request->author)
            ->orderByDesc('id');
    }

    /**
     * @param ArticleStoreRequest $request
     * @return Article
     * @throws Throwable
     */
    public function create(ArticleStoreRequest $request): Article
    {
        $data = array_merge($request->input(), [
            'created_by' => $request->user()->id
        ]);

        $article = $this->articles->create($data);
        $article->updatePhoto($request->file('photo'));

        return $article;
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return Article
     * @throws Throwable
     */
    public function update(ArticleUpdateRequest $request, Article $article): Article
    {
        $article->update($request->input());

        $image = $request->file('photo');
        if (isset($image))
            $article->updatePhoto($image);

        return $article;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $article = $this->articles->findOrfail($id);
        return $article->delete();
    }
}
