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
 * @property Language $languages
 */
class CategoryController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(CategoryService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param CategorySearchRequest $request
     * @return View
     */
    public function index(CategorySearchRequest $request): View
    {
        $categories = $this->service->search($request)
            ->withDepth()
            ->paginate(self::ITEMS_PER_PAGE);

        return $this->render('categories.categoryIndex', [
            'categories' => $categories->appends($request->input()),
        ]);
    }

    /**
     * @param Category|null $category
     * @return View
     */
    public function create(Category $category = null): View
    {
        return $this->render('categories.categoryCreate', [
            'category' => $category,
            'languages' => $this->languages->all(),
        ]);
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
            return redirect()->route('admin.categories.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return $this->render('categories.categoryShow', [
            'category' => $category,
            'descendants' => $category
                ->descendantsWithDepth()
                ->orderBy('_lft')
                ->get()
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
            'languages' => $this->languages->all(),
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
            return redirect()->route('admin.categories.index')->with('error', $e->getMessage());
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

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function moveUp(Category $category): RedirectResponse
    {
        $this->service->move($category, true);
        return redirect()->back()->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Category']));
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function moveDown(Category $category): RedirectResponse
    {
        $this->service->move($category, false);
        return redirect()->back()->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Category']));
    }
}
