<?php


namespace App\Domain\Article\ReadRepositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Article\Entities\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleReadRepository extends ReadRepository
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param integer|null $authorId
     * @param null $query
     * @return Article|Builder|null
     */
    public static function getSearchQuery(int $id = null, string $name = null, string $description = null, int $authorId = null, $query = null)
    {
        $query = $query ?? new Article();

        if (isset($id))
            $query = $query->whereKey($id);

        if (isset($name))
            $query = $query->whereEntry('name', 'LIKE', "%$name%");

        if (isset($description))
            $query = $query->whereEntry('description', 'LIKE', "%$description%");

        if(isset($authorId))
            $query = $query->where('created_by', $authorId);

        return $query;
    }
}
