<?php


namespace App\Domain\Line\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Line\Entities\Line;
use Illuminate\Database\Eloquent\Builder;

class LineReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param null $query
     * @return Line|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, $query = null)
    {
        $query = $query ?? new Line();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        return $query;
    }
}
