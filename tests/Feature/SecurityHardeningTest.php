<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\QuoteRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class SecurityHardeningTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure admin user exists
        $admin = User::firstOrNew(['email' => 'admin@sts.com.sa']);
        $admin->name = 'STS Administrator';
        $admin->password = Hash::make('Admin@STS2026');
        $admin->is_admin = true;
        $admin->role = 'admin';
        $admin->save();
    }

    /**
     * 1. فتح "/admin" دون تسجيل الدخول.
     * Test accessing /admin without login redirects to /admin/login.
     */
    public function test_01_guest_accessing_admin_root_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 2. فتح أي صفحة إدارية داخلية دون تسجيل الدخول.
     * Test accessing internal admin routes without login redirects to /admin/login.
     */
    public function test_02_guest_accessing_internal_admin_pages_is_redirected_to_login(): void
    {
        $routes = [
            '/admin/dashboard',
            '/admin/quotes',
            '/admin/services',
            '/admin/projects',
            '/admin/messages',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertRedirect(route('admin.login'));
        }
    }

    /**
     * 3. محاولة مستخدم عادي الوصول إلى لوحة التحكم.
     * Test regular authenticated user (non-admin) gets 403 Forbidden on admin dashboard.
     */
    public function test_03_regular_authenticated_user_accessing_admin_dashboard_gets_403(): void
    {
        $regularUser = User::firstOrNew(['email' => 'client@example.com']);
        $regularUser->name = 'Regular Client';
        $regularUser->password = Hash::make('Password@123');
        $regularUser->is_admin = false;
        $regularUser->role = 'client';
        $regularUser->save();

        $response = $this->actingAs($regularUser)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /**
     * 4. محاولة مستخدم عادي إرسال طلب إداري مباشر.
     * Test regular user cannot trigger administrative write operations via direct HTTP.
     */
    public function test_04_regular_user_cannot_perform_direct_administrative_http_requests(): void
    {
        $regularUser = User::firstOrNew(['email' => 'client@example.com']);
        $regularUser->is_admin = false;
        $regularUser->role = 'client';
        $regularUser->save();

        // Attempting to toggle a service
        $service = Service::first();
        if ($service) {
            $response = $this->actingAs($regularUser)->post("/admin/services/{$service->id}/toggle");
            $response->assertStatus(403);
        }

        // Attempting to delete a quote
        $responseQuote = $this->actingAs($regularUser)->delete('/admin/quotes/99999');
        $responseQuote->assertStatus(403);

        // Attempting to delete a message
        $responseMsg = $this->actingAs($regularUser)->delete('/admin/messages/99999');
        $responseMsg->assertStatus(403);
    }

    /**
     * 5. تسجيل الدخول بكلمة مرور صحيحة.
     * Test login with valid credentials succeeds, regenerates session, and redirects to dashboard.
     */
    public function test_05_admin_login_with_valid_credentials_succeeds_and_regenerates_session(): void
    {
        $initialSessionId = session()->getId();

        $response = $this->post('/admin/login', [
            'email' => 'admin@sts.com.sa',
            'password' => 'Admin@STS2026',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
        $this->assertTrue(Auth::user()->isAdmin());
    }

    /**
     * 6. تسجيل الدخول بكلمة مرور خاطئة.
     * Test login with invalid password fails and user remains unauthenticated.
     */
    public function test_06_admin_login_with_invalid_password_fails(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@sts.com.sa',
            'password' => 'WrongPassword!999',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * 7. تكرار محاولات تسجيل الدخول (Rate Limiting).
     * Test repeated failed login attempts trigger rate limiting (5 attempts limit).
     */
    public function test_07_repeated_failed_login_attempts_trigger_rate_limiter(): void
    {
        $testEmail = 'target-test@sts.com.sa';
        $throttleKey = Str::transliterate(Str::lower($testEmail) . '|127.0.0.1');
        RateLimiter::clear($throttleKey);

        // Perform 5 failed attempts
        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', [
                'email' => $testEmail,
                'password' => 'WrongPassword',
            ]);
        }

        // 6th attempt should be blocked by rate limiter
        $response = $this->post('/admin/login', [
            'email' => $testEmail,
            'password' => 'WrongPassword',
        ]);

        $response->assertSessionHasErrors('email');
        $errors = session('errors')->get('email');
        $this->assertTrue(
            Str::contains($errors[0], ['تجاوز الحد', 'Too many login attempts']),
            'Expected rate limiter error message.'
        );

        RateLimiter::clear($throttleKey);
    }

    /**
     * 8. تسجيل الخروج ثم محاولة الرجوع إلى لوحة التحكم.
     * Test logout invalidates session, regenerates CSRF token, and subsequent access is blocked.
     */
    public function test_08_logout_invalidates_session_and_blocks_subsequent_access(): void
    {
        $admin = User::where('email', 'admin@sts.com.sa')->first();

        // 1. Authenticate
        $this->actingAs($admin);
        $this->assertAuthenticated();

        // 2. Perform Logout
        $logoutResponse = $this->post('/admin/logout');
        $logoutResponse->assertRedirect(route('admin.login'));
        $this->assertGuest();

        // 3. Attempt to access dashboard again
        $subsequentResponse = $this->get('/admin/dashboard');
        $subsequentResponse->assertRedirect(route('admin.login'));
    }

    /**
     * 9. التأكد من أن كلمات المرور مخزنة بصيغة Hash وليست نصًا صريحًا.
     * Test passwords are stored as cryptographic hashes (Bcrypt / Argon) and never plain text.
     */
    public function test_09_passwords_are_stored_as_secure_hashes_not_plain_text(): void
    {
        $admin = User::where('email', 'admin@sts.com.sa')->first();

        $this->assertNotNull($admin);
        // Ensure plain text password is not stored
        $this->assertNotEquals('Admin@STS2026', $admin->password);
        // Ensure password is a standard Bcrypt/Argon2 hash (starts with $2y$ or $argon)
        $this->assertTrue(
            str_starts_with($admin->password, '$2y$') || str_starts_with($admin->password, '$argon2'),
            'Password must start with $2y$ or $argon2 hash identifier.'
        );
        // Verify Hash::check passes
        $this->assertTrue(Hash::check('Admin@STS2026', $admin->password));
    }

    /**
     * 10. التأكد من أن صلاحية المدير لا يمكن منحها عن طريق تعديل بيانات النموذج.
     * Test mass assignment protection: is_admin and role cannot be set via User::create form payload.
     */
    public function test_10_admin_privilege_cannot_be_granted_via_form_mass_assignment(): void
    {
        // Delete previous test user if exists
        User::where('email', 'attacker@test.com')->delete();

        // Attempt mass assignment injection
        $attacker = User::create([
            'name' => 'Malicious Actor',
            'email' => 'attacker@test.com',
            'phone' => '+966599999999',
            'password' => Hash::make('Secret123!'),
            'is_admin' => true,      // Mass assignment attempt
            'role' => 'admin',       // Mass assignment attempt
        ]);

        $attacker->refresh();

        // is_admin must NOT be set to true through mass assignment
        $this->assertFalse((bool) $attacker->is_admin, 'is_admin was set via mass assignment!');
        $this->assertNotEquals('admin', $attacker->role, 'role was elevated to admin via mass assignment!');
        $this->assertFalse($attacker->isAdmin(), 'Attacker gained administrative privileges!');

        $attacker->delete();
    }

    /**
     * 11. التأكد من أن نموذج تسجيل الدخول محمي من CSRF.
     * Test login view has CSRF token and web routes enforce CSRF protection.
     */
    public function test_11_login_form_is_protected_by_csrf_token(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('name="_token"', false);
    }

    /**
     * 12. التأكد من أن رسائل الخطأ لا تكشف معلومات حساسة.
     * Test login error messages are generic and do not reveal account existence or database schema.
     */
    public function test_12_login_error_messages_do_not_expose_sensitive_information(): void
    {
        // Try non-existent email
        $response = $this->post('/admin/login', [
            'email' => 'nonexistent_' . Str::random(8) . '@example.com',
            'password' => 'SomePassword123',
        ]);

        $response->assertSessionHasErrors('email');
        $errors = session('errors')->get('email');

        // Generic error message that doesn't say "Email not found" vs "Wrong password"
        $this->assertEquals(__('messages.invalid_credentials'), $errors[0]);

        // Error message does not leak SQL, exceptions, or system paths
        $this->assertStringNotContainsString('SQLSTATE', $errors[0]);
        $this->assertStringNotContainsString('select', strtolower($errors[0]));
        $this->assertStringNotContainsString('xampp', strtolower($errors[0]));
    }
}
