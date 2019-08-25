<?php


namespace Tests\Feature\Admin;


use App\Domain\User\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AdminTestCase extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setLocalizationConfigs();
    }

    protected function authenticate(string $role = User::ROLE_ADMIN)
    {
        $this->actingAs(factory(User::class)->create([
            'role' => $role,
            'status' => User::STATUS_ACTIVE,
            'verify_token' => null
        ]));
    }

    protected function logout()
    {
        Auth::logout();
    }

    private function setLocalizationConfigs()
    {
        Config::set('laravellocalization.hideDefaultLocaleInURL', true);
        Config::set('laravellocalization.useAcceptLanguageHeader ', false);
    }
}
