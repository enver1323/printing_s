<?php


namespace App\Domain\Translation\Repositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Translation\Entities\Language;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LanguageReadRepository
 * @package App\Domain\Translation\Repositories
 */
class LanguageReadRepository extends ReadRepository
{
    /**
     * @param  Builder|Language $query
     * @param string $code
     * @param string $name
     * @return Language|Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public static function getSearchQuery(string $code = null, string $name = null, $query = null)
    {
        $query = $query ?? new Language();

        if (isset($code))
            $query = $query->whereKey($code);

        if (isset($name))
            $query = $query->where('name', 'LIKE', "%$name%");

        return $query;
    }
}
