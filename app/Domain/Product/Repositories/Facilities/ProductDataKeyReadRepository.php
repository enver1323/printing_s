<?php


namespace App\Domain\Product\Repositories\Facilities;


use App\Domain\_core\ReadRepository;
use App\Domain\Product\Entities\Facilities\DataKey;
use Illuminate\Database\Eloquent\Builder;

class ProductDataKeyReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param null $query
     * @return DataKey|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, $query = null)
    {
        $query = $query ?? new DataKey();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        return $query;
    }
}
