<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Translation\Entities\Language;
use App\Domain\Translation\UseCases\LanguageService;
use App\Http\Requests\Admin\Language\LanguageSearchRequest;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class LanguageController extends AdminController
{
    /**
     * @var LanguageService
     */
    private $service;

    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LanguageSearchRequest $request
     * @return View
     */
    public function index(LanguageSearchRequest $request): View
    {
        $languages = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('languages.languageIndex', [
            'languages' => $languages->appends($request->input()),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return $this->render('languages.languageCreate');
    }

    /**
     * @param LanguageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(LanguageStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.languages.show', $this->service->store($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Language']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.languages.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Language $language
     * @return View
     */
    public function show(Language $language): View
    {
        return $this->render('languages.languageShow', [
            'language' => $language
        ]);
    }

    /**
     * @param Language $language
     * @return View
     */
    public function edit(Language $language): View
    {
        return $this->render('languages.languageEdit', [
            'language' => $language
        ]);
    }

    /**
     * @param LanguageUpdateRequest $request
     * @param Language $language
     * @return RedirectResponse
     */
    public function update(LanguageUpdateRequest $request, Language $language): RedirectResponse
    {
        try {
            return redirect()->route('admin.languages.show', $this->service->update($language, $request))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Language']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.languages.index')->with('error', $e->getMessage());
        }
    }


    /**
     * @param Language $language
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Language $language): RedirectResponse
    {
        try {
            $this->service->destroy($language);
            return redirect()->route('admin.languages.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Language']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.languages.index')->with('error', $e->getMessage());
        }
    }
}
