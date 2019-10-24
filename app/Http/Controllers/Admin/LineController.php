<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Line\Entities\Line;
use App\Domain\Line\UseCases\LineService;
use App\Http\Requests\Admin\Line\LineSearchRequest;
use App\Http\Requests\Admin\Line\LineStoreRequest;
use App\Http\Requests\Admin\Line\LineUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class LineController
 * @package App\Http\Controllers\Admin
 *
 * @property LineService $service
 */
class LineController extends AdminController
{
    private $service;

    public function __construct(LineService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LineSearchRequest $request
     * @return View
     */
    public function index(LineSearchRequest $request): View
    {
        $Lines = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('lines.lineIndex', [
            'lines' => $Lines->appends($request->input()),
        ]);
    }

    /**
     * @param Line|null $Line
     * @return View
     */
    public function create(Line $Line = null): View
    {
        return $this->render('lines.lineCreate', [
            'line' => $Line,
        ]);
    }

    /**
     * @param LineStoreRequest $request
     * @return RedirectResponse
     */
    public function store(LineStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.lines.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'line']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.lines.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param Line $line
     * @return View
     */
    public function show(Line $line): View
    {
        return $this->render('lines.lineShow', [
            'line' => $line,
        ]);
    }

    /**
     * @param Line $line
     * @return View
     */
    public function edit(Line $line): View
    {
        return $this->render('lines.lineEdit', [
            'line' => $line,
        ]);
    }

    /**
     * @param LineUpdateRequest $request
     * @param Line $line
     * @return RedirectResponse
     */
    public function update(LineUpdateRequest $request, Line $line): RedirectResponse
    {
        try {
            return redirect()->route('admin.lines.show', $this->service->update($request, $line))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Line']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.lines.index')->with('error', $e->getMessage());
        }
    }


    /**
     * @param Line $line
     * @return RedirectResponse
     */
    public function destroy(Line $line): RedirectResponse
    {
        try {
            $this->service->destroy($line->id);
            return redirect()->route('admin.lines.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Line']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.lines.index')->with('error', $e->getMessage());
        }
    }
}
