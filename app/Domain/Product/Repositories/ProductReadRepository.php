<?php


namespace App\Domain\Product\Repositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Product\Entities\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductReadRepository extends ReadRepository
{

    /**
     * @param int|null $id
     * @param string|null $name
     * @param int|null $categoryId
     * @param int|null $brandId
     * @param null $query
     * @return Product|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, int $categoryId = null, int $brandId = null, $query = null)
    {
        $query = $query ?? new Product();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        if (isset($categoryId))
            $query = $query->where('category_id', '=', $categoryId);

        if (isset($brandId))
            $query = $query->where('brand_id', '=', $brandId);

        return $query;
    }
}
