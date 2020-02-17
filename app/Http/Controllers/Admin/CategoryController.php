<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Category\Entities\Category;
use App\Domain\Category\UseCases\CategoryService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Category\CategorySearchRequest;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 *
 * @property CategoryService $service
 */
class CategoryController extends AdminController
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CategorySearchRequest $request
     * @return View
     */
    public function index(CategorySearchRequest $request): View
    {
        $categories = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('categories.categoryIndex', [
            'categories' => $categories->appends($request->input()),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return $this->render('categories.categoryCreate');
    }

    /**
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.categories.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Category']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return $this->render('categories.categoryShow', [
            'category' => $category
        ]);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return $this->render('categories.categoryEdit', [
            'category' => $category,
        ]);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        try {
            return redirect()->route('admin.categories.show', $this->service->update($request, $category))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Category']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $this->service->destroy($category->id);
            return redirect()->route('admin.categories.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Category']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', $e->getMessage());
        }
    }
}
