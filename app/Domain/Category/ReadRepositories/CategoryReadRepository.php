<?php


namespace App\Domain\Category\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Category\Entities\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param null $query
     * @return Category|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, $query = null)
    {
        $query = $query ?? new Category();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        return $query;
    }
}
