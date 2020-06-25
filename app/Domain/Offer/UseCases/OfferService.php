<?php


namespace App\Domain\Offer\UseCases;


use App\Domain\_core\Service;
use App\Domain\Offer\Entities\Offer;
use App\Domain\Offer\ReadRepositories\OfferReadRepository;
use App\Http\Requests\Admin\Offer\OfferSearchRequest;
use App\Http\Requests\Admin\Offer\OfferStoreRequest;
use App\Http\Requests\Admin\Offer\OfferUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * Class offerService
 * @package App\Domain\offer\UseCases
 *
 * @property Offer $offers
 * @property OfferReadRepository $offerReadRepo
 */
class OfferService extends Service
{
    private $offers;
    private $offerReadRepo;

    public function __construct(Offer $offers, OfferReadRepository $offerReadRepo)
    {
        $this->offers = $offers;
        $this->offerReadRepo = $offerReadRepo;
    }

    /**
     * @param OfferSearchRequest $request
     * @return Builder
     */
    public function search(OfferSearchRequest $request): Builder
    {
        return $this->offerReadRepo->getSearchQuery($request->id, $request->name, $request->description, $request->product)
            ->orderByDesc('id');
    }

    /**
     * @param OfferStoreRequest $request
     * @return offer
     * @throws Throwable
     */
    public function create(OfferStoreRequest $request): Offer
    {
        $offer = $this->offers->create($request->input());
        $offer->updatePhoto($request->file('photo'));

        return $offer;
    }

    /**
     * @param OfferUpdateRequest $request
     * @param Offer $offer
     * @return offer
     * @throws Throwable
     */
    public function update(OfferUpdateRequest $request, Offer $offer): Offer
    {
        $offer->update($request->input());

        $image = $request->file('photo');
        if (isset($image))
            $offer->updatePhoto($image);

        return $offer;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $offer = $this->offers->findOrfail($id);
        return $offer->delete();
    }
}
