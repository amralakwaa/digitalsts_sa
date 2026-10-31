<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\ServiceOffer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ServiceOfferManagementTest extends TestCase
{
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrNew(['email' => 'admin_offers_test@sts.com.sa']);
        $this->adminUser->name = 'Offers Test Admin';
        $this->adminUser->password = Hash::make('Password123!');
        $this->adminUser->is_admin = true;
        $this->adminUser->role = 'admin';
        $this->adminUser->save();
    }

    public function test_admin_can_view_service_offers_index()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.service-offers.index'));
        $response->assertStatus(200);
        $response->assertSee('إجمالي الباقات والعروض');
        $response->assertSee('إضافة باقة / عرض جديد');
    }

    public function test_admin_can_view_create_service_offer_page()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.service-offers.create'));
        $response->assertStatus(200);
        $response->assertSee('اسم الباقة بالعربية');
    }

    public function test_admin_can_store_new_service_offer()
    {
        $service = Service::first();

        $postData = [
            'title_ar'       => 'باقة الصيانة الشاملة التجريبية',
            'title_en'       => 'Comprehensive Test Maintenance Pack',
            'service_id'     => $service?->id,
            'badge_text_ar'  => 'عرض خاص',
            'badge_text_en'  => 'Special Deal',
            'description_ar' => 'وصف تجريبي للباقة الجديدة',
            'description_en' => 'Test description for new package',
            'price'          => 15000,
            'discount_price' => 12000,
            'currency'       => 'SAR',
            'billing_period' => 'project',
            'features_ar'    => "فحص دوري شهري\nقطع غيار مجانية\nدعم فني 24 ساعة",
            'features_en'    => "Monthly Inspection\nFree Spares\n24/7 Support",
            'is_featured'    => '1',
            'is_active'      => '1',
            'sort_order'     => 99,
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.service-offers.store'), $postData);
        $response->assertStatus(302);

        $this->assertDatabaseHas('service_offers', [
            'title_ar'       => 'باقة الصيانة الشاملة التجريبية',
            'price'          => 15000,
            'discount_price' => 12000,
            'is_featured'    => true,
            'is_active'      => true,
        ]);
    }

    public function test_admin_can_view_service_offer_show_page()
    {
        $offer = ServiceOffer::first();
        $this->assertNotNull($offer);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.service-offers.show', $offer->id));
        $response->assertStatus(200);
        $response->assertSee($offer->title_ar);
        $response->assertSee('قيمة الباقة (قبل الضريبة)');
    }

    public function test_admin_can_view_edit_service_offer_page()
    {
        $offer = ServiceOffer::first();
        $this->assertNotNull($offer);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.service-offers.edit', $offer->id));
        $response->assertStatus(200);
        $response->assertSee($offer->title_ar);
    }

    public function test_admin_can_update_service_offer()
    {
        $offer = ServiceOffer::create([
            'slug'           => 'temp-offer-' . rand(100, 999),
            'title_ar'       => 'باقة قبل التعديل',
            'title_en'       => 'Pack Before Edit',
            'price'          => 10000,
            'discount_price' => 8000,
            'currency'       => 'SAR',
            'billing_period' => 'project',
            'sort_order'     => 1,
            'is_active'      => true,
        ]);

        $updateData = [
            'title_ar'       => 'باقة بعد التعديل الشامل',
            'title_en'       => 'Pack After Edit',
            'badge_text_ar'  => 'جديد',
            'price'          => 9500,
            'discount_price' => 7500,
            'currency'       => 'SAR',
            'billing_period' => 'monthly',
            'features_ar'    => "بند 1\nبند 2",
            'features_en'    => "Item 1\nItem 2",
            'sort_order'     => 5,
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->put(route('admin.service-offers.update', $offer->id), $updateData);
        $response->assertRedirect(route('admin.service-offers.show', $offer->id));

        $offer->refresh();
        $this->assertEquals('باقة بعد التعديل الشامل', $offer->title_ar);
        $this->assertEquals('monthly', $offer->billing_period);

        $offer->delete();
    }

    public function test_admin_can_toggle_service_offer_active()
    {
        $offer = ServiceOffer::first();
        $this->assertNotNull($offer);

        $initialState = $offer->is_active;

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.service-offers.toggle', $offer->id));
        $response->assertStatus(302);

        $offer->refresh();
        $this->assertEquals(!$initialState, $offer->is_active);

        // Revert
        $offer->update(['is_active' => $initialState]);
    }

    public function test_admin_can_toggle_service_offer_featured()
    {
        $offer = ServiceOffer::first();
        $this->assertNotNull($offer);

        $initialFeatured = $offer->is_featured;

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.service-offers.featured', $offer->id));
        $response->assertStatus(302);

        $offer->refresh();
        $this->assertEquals(!$initialFeatured, $offer->is_featured);

        // Revert
        $offer->update(['is_featured' => $initialFeatured]);
    }

    public function test_admin_can_delete_service_offer()
    {
        $offer = ServiceOffer::create([
            'slug'           => 'delete-test-offer-' . rand(100, 999),
            'title_ar'       => 'باقة للحذف',
            'title_en'       => 'Pack To Delete',
            'price'          => 5000,
            'currency'       => 'SAR',
            'billing_period' => 'one_time',
            'sort_order'     => 99,
        ]);

        $id = $offer->id;

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->delete(route('admin.service-offers.destroy', $id));
        $response->assertRedirect(route('admin.service-offers.index'));

        $this->assertDatabaseMissing('service_offers', ['id' => $id]);
    }

    public function test_admin_can_view_service_details_show_page()
    {
        $service = Service::first();
        $this->assertNotNull($service);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.services.show', $service->id));
        $response->assertStatus(200);
        $response->assertSee($service->title_ar);
        $response->assertSee('عروض وباقات هذه الخدمة');
    }
}
