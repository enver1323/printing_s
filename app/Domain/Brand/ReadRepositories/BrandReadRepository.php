<?php


namespace App\Domain\Brand\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Brand\Entities\Brand;
use Illuminate\Database\Eloquent\Builder;

class BrandReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param null $query
     * @return Brand|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, $query = null)
    {
        $query = $query ?? new Brand();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        return $query;
    }
}
