<?php


namespace App\Domain\Offer\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Offer\Entities\Offer;
use Illuminate\Database\Eloquent\Builder;

class OfferReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param integer|null $productId
     * @param null $query
     * @return Offer|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, string $description = null, int $productId = null, $query = null)
    {
        $query = $query ?? new Offer();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        if (isset($description))
            $query = $query->whereEntry('description', 'LIKE', "%$description%");

        if(isset($productId))
            $query = $query->where('product_id', $productId);

        return $query;
    }
}
