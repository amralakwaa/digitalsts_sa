<?php

namespace Tests\Feature;

use App\Models\QuoteRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class QuoteManagementTest extends TestCase
{
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrNew(['email' => 'admin_quotes_test@sts.com.sa']);
        $this->adminUser->name = 'Quote Test Admin';
        $this->adminUser->password = Hash::make('Password123!');
        $this->adminUser->is_admin = true;
        $this->adminUser->role = 'admin';
        $this->adminUser->save();
    }

    public function test_admin_can_view_quotes_index_page()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.quotes.index'));
        $response->assertStatus(200);
        $response->assertSee('إجمالي الطلبات');
        $response->assertSee('تصدير Excel');
    }

    public function test_admin_can_view_create_quote_page()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.quotes.create'));
        $response->assertStatus(200);
        $response->assertSee('تسجيل طلب تسعير أو دراسة فنية جديدة');
    }

    public function test_admin_can_store_manual_quote()
    {
        $postData = [
            'full_name'        => 'عبدالله المحمدي',
            'email'            => 'almohammadi@testcorp.com',
            'phone'            => '+966551234567',
            'company_name'     => 'شركة المحمدي القابضة',
            'project_type'     => 'commercial',
            'location'         => 'الرياض - طريق الملك فهد',
            'estimated_budget' => '250,000 ريال',
            'message'          => 'طلب دراسة وتركيب شبكة مراقبة أمنية متكاملة للمقر الرئيسي الجديد.',
            'status'           => 'under_review',
            'admin_notes'      => 'تم استلام المكالمة وتحديد موعد معاينة يوم الأربعاء.',
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.quotes.store'), $postData);
        $response->assertStatus(302);

        $this->assertDatabaseHas('quote_requests', [
            'email'        => 'almohammadi@testcorp.com',
            'company_name' => 'شركة المحمدي القابضة',
            'status'       => 'under_review',
        ]);
    }

    public function test_admin_can_view_quote_show_page()
    {
        $quote = QuoteRequest::first();
        $this->assertNotNull($quote);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.quotes.show', $quote->id));
        $response->assertStatus(200);
        $response->assertSee($quote->reference_number);
        $response->assertSee($quote->full_name);
    }

    public function test_admin_can_view_edit_quote_page()
    {
        $quote = QuoteRequest::first();
        $this->assertNotNull($quote);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.quotes.edit', $quote->id));
        $response->assertStatus(200);
        $response->assertSee($quote->reference_number);
    }

    public function test_admin_can_update_quote()
    {
        $quote = QuoteRequest::create([
            'reference_number' => 'TEST-UPDATE-' . rand(100, 999),
            'full_name'        => 'اسم قبل التعديل',
            'email'            => 'before@test.com',
            'phone'            => '0500000000',
            'project_type'     => 'residential',
            'message'          => 'رسالة قبل التعديل',
            'status'           => 'pending',
        ]);

        $updateData = [
            'full_name'        => 'اسم بعد التعديل',
            'email'            => 'after@test.com',
            'phone'            => '0555555555',
            'company_name'     => 'مجموعة الأعمال',
            'project_type'     => 'industrial',
            'location'         => 'الدمام',
            'estimated_budget' => '100,000 ريال',
            'message'          => 'رسالة بعد التعديل الشامل',
            'status'           => 'contacted',
            'admin_notes'      => 'تم الاتصال هاتفياً',
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->put(route('admin.quotes.update', $quote->id), $updateData);
        $response->assertRedirect(route('admin.quotes.show', $quote->id));

        $quote->refresh();
        $this->assertEquals('اسم بعد التعديل', $quote->full_name);
        $this->assertEquals('contacted', $quote->status);

        $quote->delete();
    }

    public function test_admin_can_quick_update_status_via_ajax()
    {
        $quote = QuoteRequest::first();
        $this->assertNotNull($quote);

        $response = $this->actingAs($this->adminUser)->postJson(route('admin.quotes.quick_status', $quote->id), [
            'status' => 'completed',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'status' => 'completed']);

        $quote->refresh();
        $this->assertEquals('completed', $quote->status);
    }

    public function test_admin_can_bulk_update_quotes_status()
    {
        $q1 = QuoteRequest::create([
            'reference_number' => 'BULK-S1-' . rand(100, 999),
            'full_name'        => 'عميل 1',
            'email'            => 'c1@test.com',
            'phone'            => '0501111111',
            'project_type'     => 'commercial',
            'message'          => 'تجربة 1',
            'status'           => 'pending',
        ]);
        $q2 = QuoteRequest::create([
            'reference_number' => 'BULK-S2-' . rand(100, 999),
            'full_name'        => 'عميل 2',
            'email'            => 'c2@test.com',
            'phone'            => '0502222222',
            'project_type'     => 'commercial',
            'message'          => 'تجربة 2',
            'status'           => 'pending',
        ]);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.quotes.bulkStatus'), [
            'ids'    => [$q1->id, $q2->id],
            'status' => 'under_review',
        ]);

        $response->assertRedirect(route('admin.quotes.index'));

        $this->assertEquals('under_review', $q1->fresh()->status);
        $this->assertEquals('under_review', $q2->fresh()->status);

        $q1->delete();
        $q2->delete();
    }

    public function test_admin_can_bulk_delete_quotes()
    {
        $q1 = QuoteRequest::create([
            'reference_number' => 'BULK-D1-' . rand(100, 999),
            'full_name'        => 'حذف 1',
            'email'            => 'd1@test.com',
            'phone'            => '0501111111',
            'project_type'     => 'commercial',
            'message'          => 'تجربة حذف 1',
            'status'           => 'cancelled',
        ]);
        $q2 = QuoteRequest::create([
            'reference_number' => 'BULK-D2-' . rand(100, 999),
            'full_name'        => 'حذف 2',
            'email'            => 'd2@test.com',
            'phone'            => '0502222222',
            'project_type'     => 'commercial',
            'message'          => 'تجربة حذف 2',
            'status'           => 'cancelled',
        ]);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.quotes.bulkDelete'), [
            'ids' => [$q1->id, $q2->id],
        ]);

        $response->assertRedirect(route('admin.quotes.index'));
        $this->assertDatabaseMissing('quote_requests', ['id' => $q1->id]);
        $this->assertDatabaseMissing('quote_requests', ['id' => $q2->id]);
    }

    public function test_admin_can_export_quotes_csv()
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.quotes.export'));
        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->headers->get('content-type'), 'text/csv'));
    }
}
