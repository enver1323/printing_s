<?php


namespace App\Domain\Country\UseCases;


use App\Domain\Country\Entities\Country;
use App\Domain\Country\ReadRepositories\CountryReadRepository;
use App\Http\Requests\Admin\Country\CountrySearchRequest;
use App\Http\Requests\Admin\Country\CountryStoreRequest;
use App\Http\Requests\Admin\Country\CountryUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CountryService
 * @package App\Domain\Country\UseCases
 *
 * @property Country $countries
 * @property CountryReadRepository $countryReadRepo
 */
class CountryService
{
    private $countries;
    private $countryReadRepo;

    public function __construct(Country $countries, CountryReadRepository $countryReadRepo)
    {
        $this->countries = $countries;
        $this->countryReadRepo = $countryReadRepo;
    }

    /**
     * @param CountrySearchRequest $request
     * @return Builder
     */
    public function search(CountrySearchRequest $request): Builder
    {
        $query = $this->countryReadRepo::getSearchQuery($request->id, $request->name, $request->code);

        return $query->orderBy('id', 'desc');
    }

    /**
     * @param CountryStoreRequest $request
     * @return Country
     * @throws \Throwable
     */
    public function create(CountryStoreRequest $request): Country
    {
        $country = $this->countries->create($request->validated());

        return $country;
    }

    /**
     * @param Country $country
     * @param CountryUpdateRequest $request
     * @return Country
     */
    public function update(Country $country, CountryUpdateRequest $request): Country
    {
        $country->update($request->input());

        return $country;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id): ?bool
    {
        $country = $this->countries->findOrFail($id);

        return $country->delete();
    }
}
