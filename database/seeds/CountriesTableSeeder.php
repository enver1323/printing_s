<?php

use App\Domain\Country\Entities\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    const API_URL = 'https://restcountries.eu/rest/v2/all';
    const API_STORAGE_PATH = 'app/countries.json';

    public function run()
    {
        $data = file_get_contents(self::API_URL) ?? file_get_contents(storage_path(self::API_STORAGE_PATH));
        $data = collect(json_decode($data));

        foreach ($data as $country) {
            $country = (object)$country;

            if (!$this->createModels($country) && isset($country->altSpellings[1])) {
                $country->name = $country->altSpellings[1];
                if(!$this->createModels($country))
                    echo sprintf("Country Error: %s\n", $country->name);
            }
        }
    }

    /**
     * @param stdClass $country
     * @return bool
     * @throws Exception
     */
    private function createModels(stdClass $country): bool
    {
        try {
            DB::beginTransaction();
            $model = $this->createCountry($country);
            $region = $this->createRegion($model, $country);
            DB::commit();

            return true;
        } catch (Exception | Throwable $exception) {
            DB::rollBack();

            return false;
        }
    }

    /**
     * @param stdClass $country
     * @return Country
     * @throws Throwable
     */
    private function createCountry(stdClass $country): Country
    {
        $model = new Country([
            'name->en' => $country->name,
            'code' => $country->alpha2Code,
            'lat' => $country->latlng[0],
            'lng' => $country->latlng[1],
            'phone_code' => $country->callingCodes[0] ?? null
        ]);

        $model->updatePhoto($country->flag);

        return $model;
    }

    /**
     * @param Country $model
     * @param stdClass $country
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createRegion(Country $model, stdClass $country)
    {
        return $model->regions()->create([
            'name->en' => $country->capital,
            'lat' => $country->latlng[0],
            'lng' => $country->latlng[1],
        ]);
    }
}
