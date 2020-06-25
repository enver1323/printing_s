<?php


namespace App\Http\Controllers\Admin;

use App\Domain\Offer\Entities\Offer;
use App\Domain\Offer\UseCases\OfferService;
use App\Http\Requests\Admin\Offer\OfferSearchRequest;
use App\Http\Requests\Admin\Offer\OfferStoreRequest;
use App\Http\Requests\Admin\Offer\OfferUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

/**
 * Class offerController
 * @package App\Http\Controllers\Admin
 *
 * @property offerService $service
 */
class OfferController extends AdminController
{
    private $service;

    public function __construct(OfferService $service)
    {
        $this->service = $service;
    }

    /**
     * @param OfferSearchRequest $request
     * @return View
     */
    public function index(OfferSearchRequest $request): View
    {
        $offers = $this->service->search($request)->paginate(self::ITEMS_PER_PAGE);

        return $this->render('offers.offerIndex', [
            'offers' => $offers->appends($request->input()),
        ]);
    }

    /**
     * @param Offer|null $offer
     * @return View
     */
    public function create(Offer $offer = null): View
    {
        return $this->render('offers.offerCreate', [
            'offer' => $offer,
        ]);
    }

    /**
     * @param OfferStoreRequest $request
     * @return RedirectResponse
     */
    public function store(OfferStoreRequest $request): RedirectResponse
    {
        try {
            return redirect()->route('admin.offers.show', $this->service->create($request))
                ->with('success', __('adminPanel.messages.adminAction.success.create', ['name' => 'offer']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param offer $offer
     * @return View
     */
    public function show(Offer $offer): View
    {
        return $this->render('offers.offerShow', [
            'offer' => $offer,
        ]);
    }

    /**
     * @param Offer $offer
     * @return View
     */
    public function edit(Offer $offer): View
    {
        return $this->render('offers.offerEdit', [
            'offer' => $offer
        ]);
    }

    /**
     * @param OfferUpdateRequest $request
     * @param Offer $offer
     * @return RedirectResponse
     */
    public function update(OfferUpdateRequest $request, Offer $offer): RedirectResponse
    {
        try {
            return redirect()->route('admin.offers.show', $this->service->update($request, $offer))
                ->with('success', __('adminPanel.messages.adminAction.success.update', ['name' => 'offer']));
        } catch (Throwable | Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    /**
     * @param offer $offer
     * @return RedirectResponse
     */
    public function destroy(Offer $offer): RedirectResponse
    {
        try {
            $this->service->destroy($offer->id);
            return redirect()->route('admin.offers.index')
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'offer']));
        } catch (Throwable | Exception $e) {
            return redirect()->route('admin.offers.index')->with('error', $e->getMessage());
        }
    }

    /**
     * @param offer $offer
     * @return RedirectResponse
     */
    public function deletePhoto(Offer $offer)
    {
        try {
            $offer->deletePhoto();
            return redirect()->back()
                ->with('success', __('adminPanel.messages.adminAction.success.delete', ['name' => 'offer photo']));
        } catch (\Exception | \Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
