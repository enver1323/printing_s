<?php


namespace App\Http\Controllers\Web;


use App\Domain\Offer\Entities\Offer;
use Illuminate\View\View;

/**
 * Class OfferController
 * @package App\Http\Controllers\Web
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property Offer $offers
 */
class OfferController extends WebController
{
    private $offers;

    public function __construct(Offer $offers)
    {
        $this->offers = $offers;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $offers = $this->offers->with('product')->paginate(self::ITEMS_PER_PAGE);
        return $this->render('offers.offerList', [
            'offers' => $offers
        ]);
    }

    /**
     * @param Offer $offer
     * @return View
     */
    public function show(Offer $offer): View
    {
        return $this->render('offers.offer', [
            'offer' => $offer
        ]);
    }

}
