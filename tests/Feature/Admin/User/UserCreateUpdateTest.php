<?php


namespace Tests\Feature\Admin\User;


use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Tests\Feature\Admin\AdminTestCase;

class UserCreateUpdateTest extends AdminTestCase
{
    const EMAIL = 'testEmail@fakeMail.com';

    /**
     * @var User
     */
    private static $user;

    private function checkUser(TestResponse $response): void
    {
        self::$user = User::where('email', '=', self::EMAIL)->first();
        $response->assertRedirect(route("admin.users.show", self::$user));

        $this->checkSavedUserData();
    }

    public function testCreate()
    {
        $this->informTest('testCreate');
        $this->authenticate();

        $this->checkUser($this->post(route('admin.users.store'), $this->getUserRequestData()->toArray()));
        $this->logout();
    }

    public function testUpdate()
    {
        $this->informTest('testUpdate');
        $this->authenticate();

        self::$user = factory(User::class)->create();
        factory(Profile::class)->create(['user_id' => self::$user->id]);
        $this->checkUser($this->patch(route('admin.users.update', self::$user), $this->getUserRequestData()->toArray()));
        $this->logout();
    }

    private function getUserRequestData(): Collection
    {
        $pass = bcrypt('password');

        return collect([
            'name' => 'testName',
            'email' => self::EMAIL,
            'password' => $pass,
            'password_confirmation' => $pass,
            'role' => User::ROLE_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'profile' => [
                'name' => 'testRealName',
                'family_name' => 'testSurName',
                'nickname' => 'testNickName',
                'birth_date' => '2019-08-12',
                'photo' => UploadedFile::fake()->image('testImage.png'),
                'gender' => Profile::GENDER_MALE,
            ],
            '_token' => csrf_token()
        ]);
    }

    private function checkSavedUserData(): void
    {
        $data = $this->getUserRequestData()->except(['password', 'password_confirmation', '_token']);
        $userData = $data->except('profile');
        $profileData = $data->except(['profile.photo', 'profile.birth_date'])->get('profile');

        $profile = self::$user->profile;

        foreach ($userData as $key => $field)
            $this->assertEquals(self::$user->$key, $field);

        foreach ($profileData as $key => $field)
            $this->assertEquals($profile->$key, $field);

        $this->assertTrue(File::exists($profile->photo->getStoragePathName()));
        foreach ($profile->getPhotoSizes() as $size => $sizeData)
            $this->assertTrue(File::exists($profile->photo->getStoragePathName($size)));
    }
}
