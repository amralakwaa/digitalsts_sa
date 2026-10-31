<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class UserLoginVerificationTest extends TestCase
{
    protected User $admin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrNew(['email' => 'admin@sts.com.sa']);
        $this->admin->name = 'STS Administrator';
        $this->admin->password = Hash::make('Admin@STS2026');
        $this->admin->is_admin = true;
        $this->admin->role = 'admin';
        $this->admin->save();

        $this->regularUser = User::firstOrNew(['email' => 'client@example.com']);
        $this->regularUser->name = 'Regular Client';
        $this->regularUser->password = Hash::make('Password@123');
        $this->regularUser->is_admin = false;
        $this->regularUser->role = 'client';
        $this->regularUser->save();
    }

    /** Test login form renders properly with all interactive controls */
    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('STS');
        $response->assertSee('togglePasswordBtn');
        $response->assertSee('_token');
    }

    /** Test valid admin user logs in and accesses dashboard */
    public function test_admin_user_can_login_successfully(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@sts.com.sa',
            'password' => 'Admin@STS2026',
            'remember' => '1',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);
        $this->assertTrue(Auth::user()->isAdmin());
    }

    /** Test regular non-admin user is rejected with permission error and session invalidated */
    public function test_non_admin_user_is_prevented_from_logging_into_admin_portal(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'client@example.com',
            'password' => 'Password@123',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** Test invalid password fails and shows error */
    public function test_invalid_password_fails(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@sts.com.sa',
            'password' => 'IncorrectPassword123',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** Test logout invalidates session */
    public function test_user_can_logout_and_session_is_invalidated(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/logout');
        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
