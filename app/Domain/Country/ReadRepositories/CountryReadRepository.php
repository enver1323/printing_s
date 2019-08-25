<?php


namespace App\Domain\Country\ReadRepositories;


use App\Domain\Country\Entities\Country;
use Illuminate\Database\Eloquent\Builder;

class CountryReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $code
     * @param Builder|Country $query
     * @return mixed
     */
    public static function getSearchQuery(int $id = null, string $name = null, string $code = null, $query = null)
    {
        $query = $query ?? new Country();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        if (isset($code))
            $query = $query->where('code', '=', $code);

        return $query;
    }
}
