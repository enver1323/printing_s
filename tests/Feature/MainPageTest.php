<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageTest extends TestCase
{
    public function testRouteRedirectLocale()
    {
        $this->informTest('testRouteRedirectLocale');
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
