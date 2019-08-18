<?php


namespace App\Domain\Translation\Repositories;


use App\Domain\_core\ReadRepository;
use App\Domain\Translation\Entities\Language;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LanguageReadRepository
 * @package App\Domain\Translation\Repositories
 *
 * @property Language $languages
 */
class LanguageReadRepository extends ReadRepository
{
    private $languages;

    public function __construct(Language $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param  Builder|Language $query
     * @param string $code
     * @param string $name
     * @return Language|Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public function getSearchQuery($query, string $code = null, string $name = null)
    {
        if (isset($code))
            $query = $query->whereKey($code);

        if (isset($name))
            $query = $query->where('name', 'LIKE', "%$name%");

        return $query;
    }
}
