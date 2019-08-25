<?php


namespace Tests\Feature\Admin\Region;


use App\Domain\Country\Entities\Country;
use App\Domain\Country\Entities\Region;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Collection;
use Tests\Feature\Admin\AdminTestCase;

class RegionCreateUpdateTest extends AdminTestCase
{
    private static $region;
    private static $country_id;
    private static $parent_id;

    const SLUG = 'testRegionSlug';

    private function checkCountry(TestResponse $response)
    {
        self::$region = Region::where('slug', '=',self::SLUG)->first();
        $response->assertRedirect(route("admin.regions.show", self::$region));

        $this->checkSavedRegionData();
    }

    public function testCreate()
    {
        $this->informTest('testCreate');
        $this->authenticate();

        $this->checkCountry($this->post(route('admin.regions.store'),
            $this->getRegionData()->toArray()
        ));

        $this->logout();
    }

    public function testUpdate()
    {
        $this->informTest('testUpdate');
        $this->authenticate();

        self::$region = factory(Region::class)->create();
        $this->checkCountry($this->patch(route('admin.regions.update', self::$region),
            $this->getRegionData()->toArray()
        ));

        $this->logout();
    }

    private function getRegionData(): Collection
    {
        self::$country_id = self::$country_id ?? Country::inRandomOrder()->first('id')->id;
        self::$parent_id = self::$parent_id ?? Region::whereKeyNot(self::SLUG)->inRandomOrder()->first('id')->id;

        return collect([
            'name' => ['en' => 'testRegion'],
            'country_id' => self::$country_id,
            'parent_id' => self::$parent_id,
            'slug' => self::SLUG,
            'lat' => 90,
            'lng' => 180,
            '_token' => csrf_token()
        ]);
    }

    private function checkSavedRegionData(): void
    {
        $data = $this->getRegionData()->except(['_token', 'name']);

        $this->assertEquals(self::$region->name, $this->getRegionData()['name']['en']);

        foreach ($data as $key => $field)
            $this->assertEquals(self::$region->$key, $field);
    }
}
