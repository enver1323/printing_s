<?php


namespace App\Domain\Country\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Country\Entities\Region;
use Illuminate\Database\Eloquent\Builder;

class RegionReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $country
     * @param string|null $parent
     * @param string|null $slug
     * @param Builder|null $query
     * @return Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, string $country = null, string $parent = null, string $slug = null, $query = null)
    {
        $query = $query ?? new Region();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");


        if (isset($country))
            $query = $query->whereHas('country', function (Builder $query) use ($country) {
                $query->whereEntry('name', 'LIKE', $country);
            });


        return $query;
    }
}
