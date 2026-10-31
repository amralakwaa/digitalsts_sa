<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\QuoteRequest;

class StsPlatformTest extends TestCase
{
    /** Test home page loads with 200 */
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('STS');
    }

    /** Test services index page */
    public function test_services_page_loads(): void
    {
        $response = $this->get('/services');
        $response->assertStatus(200);
    }

    /** Test individual service page */
    public function test_single_service_page_loads(): void
    {
        $service = Service::first();
        if ($service) {
            $response = $this->get("/services/{$service->slug}");
            $response->assertStatus(200);
            $response->assertSee($service->title);
        }
    }

    /** Test sectors page */
    public function test_sectors_page_loads(): void
    {
        $response = $this->get('/sectors');
        $response->assertStatus(200);
    }

    /** Test projects page */
    public function test_projects_page_loads(): void
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    /** Test quote page loads */
    public function test_quote_page_loads(): void
    {
        $response = $this->get('/quote');
        $response->assertStatus(200);
    }

    /** Test contact page loads */
    public function test_contact_page_loads(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    /** Test language switching */
    public function test_language_switch(): void
    {
        $response = $this->get('/lang/en');
        $response->assertRedirect();
        $this->assertEquals('en', session('locale'));

        $responseAr = $this->get('/lang/ar');
        $responseAr->assertRedirect();
        $this->assertEquals('ar', session('locale'));
    }

    /** Test quote request submission */
    public function test_quote_request_submission_stores_in_database(): void
    {
        $payload = [
            'full_name' => 'Eng. Fahad Al-Otaibi',
            'email' => 'fahad@example.com',
            'phone' => '+966501112233',
            'company_name' => 'Al-Otaibi Enterprises',
            'project_type' => 'commercial',
            'location' => 'Riyadh',
            'estimated_budget' => '100,000 SAR',
            'message' => 'Requesting itemized proposal for 60 CCTV 4K IP cameras and biometric access gates for our commercial headquarters in Olaya.',
        ];

        $response = $this->post('/quote', $payload);

        $response->assertRedirect(route('quote.create'));
        $response->assertSessionHas('quote_success', true);

        $this->assertDatabaseHas('quote_requests', [
            'email' => 'fahad@example.com',
            'full_name' => 'Eng. Fahad Al-Otaibi',
            'status' => 'pending',
        ]);
    }

    /** Test guest cannot access admin dashboard */
    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('admin.login'));
    }

    /** Test admin can log in and view dashboard */
    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::where('email', 'admin@sts.com.sa')->first();
        if ($admin) {
            $response = $this->actingAs($admin)->get('/admin/dashboard');
            $response->assertStatus(200);
            $response->assertSee('STS PORTAL');
        }
    }
}
