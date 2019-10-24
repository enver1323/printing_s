<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Slide\Entities\Slide;
use App\Domain\Slide\UseCases\SlideService;
use App\Http\Requests\Admin\Slide\SlideStoreRequest;
use App\Http\Requests\Admin\Slide\SlideUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class SlideController
 * @package App\Http\Controllers\Admin
 *
 * @property SlideService $service
 */
class SlideController extends AdminController
{
    private $service;

    /**
     * SlideController constructor.
     * @param SlideService $service
     */
    public function __construct(SlideService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $slides = Slide::orderBy('order')->paginate(self::ITEMS_PER_PAGE);

        return $this->render('slides.slideIndex', [
            'slides' => $slides,
        ]);
    }

    /**
     * @param Slide|null $slide
     * @return View
     */
    public function create(Slide $slide = null): View
    {
        return $this->render('slides.slideCreate', [
            'slide' => $slide,
        ]);
    }

    /**
     * @param SlideStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SlideStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.slides.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'Slide']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Slide $slide
     * @return View
     */
    public function show(Slide $slide): View
    {
        return $this->render('slides.slideShow', [
            'slide' => $slide,
        ]);
    }

    /**
     * @param Slide $slide
     * @return View
     */
    public function edit(Slide $slide): View
    {
        return $this->render('slides.slideEdit', [
            'slide' => $slide
        ]);
    }

    /**
     * @param SlideUpdateRequest $request
     * @param Slide $slide
     * @return RedirectResponse
     */
    public function update(SlideUpdateRequest $request, Slide $slide): RedirectResponse
    {
        try {
            return redirect()->route('admin.slides.show', $this->service->update($request, $slide))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Slide']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * @param Slide $slide
     * @return RedirectResponse
     */
    public function destroy(Slide $slide): RedirectResponse
    {
        try {
            $this->service->destroy($slide->id);
            return redirect()->route('admin.slides.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'Slide']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.Slides.index')->with('error', $e->getMessage());
        }
    }

    public function imageLeft(Slide $slide)
    {
        try {
            $this->service->moveImage($slide, false);
            return redirect()->route('admin.slides.index')
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Slide']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.Slides.index')->with('error', $e->getMessage());
        }
    }

    public function imageRight(Slide $slide)
    {
        try {
            $this->service->moveImage($slide, true);
            return redirect()->route('admin.slides.index')
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'Slide']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.Slides.index')->with('error', $e->getMessage());
        }
    }
}
