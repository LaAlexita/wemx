<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.installed' => true]);
    }

    public function test_login_page_loads(): void
    {
        $this->get('/auth/login')->assertStatus(200);
    }

    public function test_register_page_loads(): void
    {
        $this->get('/auth/register')->assertStatus(200);
    }

    public function test_root_does_not_error(): void
    {
        $status = $this->get('/')->status();

        $this->assertLessThan(500, $status,
            "GET / returned {$status}; route should respond without server error.");
    }

    public function test_admin_area_rejects_unauthenticated_users(): void
    {
        $response = $this->get('/admin');

        $this->assertContains($response->status(), [302, 401, 403],
            'Unauthenticated /admin access must not return 200.');
    }

    public function test_install_redirect_when_not_installed(): void
    {
        config(['app.installed' => false]);

        $this->get('/auth/login')->assertRedirect(route('install.index'));
    }
}
