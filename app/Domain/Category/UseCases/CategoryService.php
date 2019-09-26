<?php


namespace App\Domain\Category\UseCases;


use App\Domain\_core\Service;
use App\Domain\Category\Entities\Category;
use App\Domain\Category\ReadRepositories\CategoryReadRepository;
use App\Http\Requests\Admin\Category\CategorySearchRequest;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CategoryService
 * @package App\Domain\Category\UseCases
 *
 * @property Category $categories
 * @property CategoryReadRepository $categoryReadRepo
 */
class CategoryService extends Service
{
    private $categoryReadRepo;
    private $categories;

    public function __construct(Category $categories, CategoryReadRepository $categoryReadRepo)
    {
        $this->categoryReadRepo = $categoryReadRepo;
        $this->categories = $categories;
    }

    /**
     * @param CategorySearchRequest $request
     * @return Builder
     */
    public function search(CategorySearchRequest $request): Builder
    {
        return $this->categoryReadRepo->getSearchQuery($request->id, $request->name)
            ->orderByDesc('created_at');
    }

    /**
     * @param CategoryStoreRequest $request
     * @return Category
     * @throws \Throwable
     */
    public function create(CategoryStoreRequest $request): Category
    {
        $category = $this->categories->create($request->except('photo'));
        $category->updatePhoto($request->file('photo'));

        return $category;
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return Category
     * @throws \Throwable
     */
    public function update(CategoryUpdateRequest $request, Category $category): Category
    {
        $category->update($request->except('photo'));
        $category->updatePhoto($request->file('photo'));

        return $category;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $category = $this->categories->findOrfail($id);
        return $category->delete();
    }
}
