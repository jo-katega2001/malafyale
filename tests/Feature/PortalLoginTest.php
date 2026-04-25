<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_portal_credentials_can_log_in(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@mwalafyale.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }
}
