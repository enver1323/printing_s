<?php


namespace App\Domain\Slide\UseCases;


use App\Domain\_core\Service;
use App\Domain\Slide\Entities\Slide;
use App\Http\Requests\Admin\Slide\SlideStoreRequest;
use App\Http\Requests\Admin\Slide\SlideUpdateRequest;
use Throwable;

/**
 * Class slideService
 * @package App\Domain\slide\UseCases
 *
 * @property Slide $slides
 */
class SlideService extends Service
{
    private $slides;

    public function __construct(Slide $slides)
    {
        $this->slides = $slides;
    }

    /**
     * @param SlideStoreRequest $request
     * @return Slide
     * @throws Throwable
     */
    public function create(SlideStoreRequest $request): Slide
    {
        $slide = $this->slides->create($request->input());

        if($photo = $request->file('photo'))
            $slide->updatePhoto($photo);

        return $slide;
    }

    /**
     * @param SlideUpdateRequest $request
     * @param Slide $slide
     * @return Slide
     * @throws Throwable
     */
    public function update(SlideUpdateRequest $request, Slide $slide): Slide
    {
        $slide->update($request->input());

        if($photo = $request->file('photo'))
            $slide->updatePhoto($photo);

        return $slide;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $slide = $this->slides->findOrfail($id);
        return $slide->delete();
    }

    /**
     * @param Slide $slide
     * @param bool $toRight
     */
    public function moveImage(Slide $slide, bool $toRight): void
    {
        $oldOrder = $slide->order;
        $slide->order += $toRight ? 1 : - 1;

        $subSlide = $this->slides->where('order', '=', $slide->order)->first();
        $subSlide->order = $oldOrder;

        $slide->save();
        $subSlide->save();
    }
}
