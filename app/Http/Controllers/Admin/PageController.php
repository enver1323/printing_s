<?php


namespace App\Http\Controllers\Admin;

use App\Domain\Page\Entities\Page;
use App\Domain\Page\Entities\PageDocument;
use App\Domain\Page\UseCases\PageService;
use App\Domain\Translation\Entities\Language;
use App\Http\Requests\Admin\Page\PageSearchRequest;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 *
 * @property PageService $service
 * @property Language $languages
 */
class PageController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(PageService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param PageSearchRequest $request
     * @return View
     */
    public function index(PageSearchRequest $request): View
    {
        $pages = $this->service->search($request)
            ->paginate(self::ITEMS_PER_PAGE);

        return $this->render('pages.pageIndex', [
            'pages' => $pages->appends($request->input()),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return $this->render('pages.pageCreate');
    }

    /**
     * @param PageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PageStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.pages.show', $this->service->store($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param Page $page
     * @return View
     */
    public function show(Page $page): View
    {
        return $this->render('pages.pageShow', [
            'page' => $page
        ]);
    }

    /**
     * @param Page $page
     * @return View
     */
    public function edit(Page $page): View
    {
        return $this->render('pages.pageEdit', ['page' => $page]);
    }

    /**
     * @param PageUpdateRequest $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        try {
            return redirect()->route('admin.pages.show', $this->service->update($request, $page))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    /**
     * @param Page $page
     * @return RedirectResponse
     */
    public function destroy(Page $page): RedirectResponse
    {
        try {
            $this->service->destroy($page->id);
            return redirect()->route('admin.pages.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Item']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.pages.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param PageDocument $document
     * @return RedirectResponse
     */
    public function deleteDocument(PageDocument $document)
    {
        try {
            $document->delete();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Item document']));
        } catch (Exception | Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
