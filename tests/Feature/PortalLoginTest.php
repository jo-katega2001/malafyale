<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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

    public function test_portal_login_resets_the_default_admin_password(): void
    {
        User::where('email', 'admin@mwalafyale.com')
            ->update(['password' => Hash::make('old-password')]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@mwalafyale.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }
}
