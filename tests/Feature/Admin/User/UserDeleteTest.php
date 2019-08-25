<?php


namespace Tests\Feature\Admin\User;


use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use Tests\Feature\Admin\AdminTestCase;

class UserDeleteTest extends AdminTestCase
{
    public function testDelete()
    {
        $this->informTest('testDelete');
        $this->authenticate();

        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create(['user_id' => $user->id]);

        $response = $this->delete(route('admin.users.destroy', $user));
        $response->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success');

        $this->assertTrue(User::find($user)->isEmpty());
        $this->assertTrue(Profile::find($profile)->isEmpty());

        $this->logout();
    }
}
