<?php


namespace App\Domain\Page\Repositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Page\Entities\Page;
use Illuminate\Database\Eloquent\Builder;

class PageReadRepository extends ReadRepository
{

    /**
     * @param int|null $id
     * @param string|null $name
     * @param int|null $content
     * @param null $query
     * @return Page|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, int $content = null, $query = null)
    {
        $query = $query ?? new Page();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        if (isset($content))
            $query = $query->whereEntry('content', 'LIKE', "%$content%");

        return $query;
    }
}
