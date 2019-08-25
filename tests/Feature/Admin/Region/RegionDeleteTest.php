<?php


namespace Tests\Feature\Admin\Region;


use App\Domain\Country\Entities\Region;
use Tests\Feature\Admin\AdminTestCase;

class RegionDeleteTest extends AdminTestCase
{
    public function testDelete()
    {
        $this->informTest('testDelete');
        $this->authenticate();

        $region = factory(Region::class)->create();

        $response = $this->delete(route('admin.regions.destroy', $region));
        $response->assertRedirect(route('admin.countries.index'))
            ->assertSessionHas('success');

        $this->logout();
    }
}
