<?php


namespace App\Domain\Translation\UseCases;


use App\Domain\_core\Service;
use App\Domain\Translation\Entities\Language;
use App\Domain\Translation\Repositories\LanguageReadRepository;
use App\Http\Requests\Admin\Language\LanguageSearchRequest;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LanguageService
 * @package App\Domain\Translation\UseCases
 *
 * @property Language $languages
 * @property LanguageReadRepository $langReadRepo
 */
class LanguageService extends Service
{
    private $languages;
    private $langReadRepo;

    public function __construct(Language $languages, LanguageReadRepository $langReadRepo)
    {
        $this->languages = $languages;
        $this->langReadRepo = $langReadRepo;
    }

    /**
     * @param LanguageSearchRequest $request
     * @return Language|Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public function search(LanguageSearchRequest $request)
    {
        $query = $this->langReadRepo->getSearchQuery($request->code, $request->name);

        return $query;
    }

    /**
     * @param LanguageStoreRequest $request
     * @return Language
     */
    public function store(LanguageStoreRequest $request): Language
    {
        return $this->languages->create($request->validated());
    }

    /**
     * @param Language $language
     * @param LanguageUpdateRequest $request
     * @return Language
     */
    public function update(Language $language, LanguageUpdateRequest $request): Language
    {
        $language->update($request->validated());

        return $language;
    }

    /**
     * @param Language $language
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Language $language): ?bool
    {
        return $language->delete();
    }
}
