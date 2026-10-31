<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\QuoteRequest;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminModulesTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::firstOrNew(['email' => 'admin@sts.com.sa']);
        $this->admin->name = 'STS Administrator';
        $this->admin->password = Hash::make('Admin@STS2026');
        $this->admin->is_admin = true;
        $this->admin->role = 'admin';
        $this->admin->save();
    }

    /** Test admin can view settings index and update settings */
    public function test_admin_can_view_and_update_site_settings(): void
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->admin)->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('إعدادات الموقع');

        $updateResponse = $this->actingAs($this->admin)->post('/admin/settings', [
            'settings' => [
                'contact_phone' => [
                    'ar' => '+966 11 999 8888',
                    'en' => '+966 11 999 8888',
                ],
            ],
        ]);

        $updateResponse->assertRedirect(route('admin.settings.index'));
        $updateResponse->assertSessionHas('success');
        $this->assertEquals('+966 11 999 8888', SiteSetting::get('contact_phone'));
    }

    /** Test admin can view users index and create new admin */
    public function test_admin_can_view_users_and_create_new_user(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');
        $response->assertStatus(200);

        User::where('email', 'newadmin@sts.com.sa')->delete();

        $createResponse = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Eng. Fahad Operations',
            'email' => 'newadmin@sts.com.sa',
            'phone' => '+966509998877',
            'password' => 'Password@123456',
            'password_confirmation' => 'Password@123456',
            'is_admin' => 1,
        ]);

        $createResponse->assertRedirect(route('admin.users.index'));
        $createResponse->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@sts.com.sa',
            'is_admin' => 1,
            'role' => 'admin',
        ]);

        User::where('email', 'newadmin@sts.com.sa')->delete();
    }

    /** Test admin can create, edit, toggle and delete service with image & features */
    public function test_admin_can_manage_services_with_image_and_features(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->get('/admin/services/create');
        $response->assertStatus(200);

        // create fake file without GD dependency
        $fakeImage = UploadedFile::fake()->create('service_test.jpg', 200, 'image/jpeg');

        $createResponse = $this->actingAs($this->admin)->post('/admin/services', [
            'title_ar' => 'أنظمة التحكم بالدخول البيومترية',
            'title_en' => 'Biometric Access Control Systems',
            'description_ar' => 'حلول متقدمة للتحكم بالأبواب والبوابات',
            'description_en' => 'Advanced biometric physical access control',
            'content_ar' => 'شرح تفصيلي للأنظمة البيومترية والمواصفات الأمنية المعتمدة',
            'content_en' => 'Detailed technical specifications for biometric sensors',
            'icon' => 'lock',
            'sort_order' => 50,
            'is_active' => 1,
            'image' => $fakeImage,
            'features_ar' => "بصمة الوجه ثلاثية الأبعاد\nربط شبكي مركزي\nمتوافق مع كود الأمان",
            'features_en' => "3D Facial Recognition\nCentralized Network\nSecurity Code Compliant",
            'benefits_ar' => "منع الدخول غير المصرح به\nسجلات دقيقة للحضور",
            'benefits_en' => "Prevent unauthorized access\nAccurate attendance auditing",
            'sectors_ar' => "المباني الحكومية\nالبنوك والمصارف",
            'sectors_en' => "Government Buildings\nBanking & Financial",
        ]);

        $createResponse->assertRedirect(route('admin.services.index'));
        $createResponse->assertSessionHas('success');

        $service = Service::where('title_ar', 'أنظمة التحكم بالدخول البيومترية')->first();
        $this->assertNotNull($service);
        $this->assertEquals('lock', $service->icon);
        $this->assertCount(3, $service->features_ar);
        $this->assertCount(2, $service->benefits_ar);
        $this->assertCount(2, $service->sectors_ar);
        $this->assertNotNull($service->image);
        Storage::disk('public')->assertExists($service->image);

        // Test Edit View
        $editResponse = $this->actingAs($this->admin)->get(route('admin.services.edit', $service->id));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('أنظمة التحكم بالدخول البيومترية');

        // Test Toggle Status
        $toggleResponse = $this->actingAs($this->admin)->post(route('admin.services.toggle', $service->id));
        $toggleResponse->assertRedirect();
        $this->assertFalse($service->fresh()->is_active);

        // Test Delete Service
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.services.destroy', $service->id));
        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    /** Test admin can manage projects with cover image and gallery images */
    public function test_admin_can_manage_projects_with_cover_and_gallery(): void
    {
        Storage::fake('public');

        $coverFile = UploadedFile::fake()->create('project_cover.jpg', 300, 'image/jpeg');
        $galFile1 = UploadedFile::fake()->create('gal1.jpg', 300, 'image/jpeg');
        $galFile2 = UploadedFile::fake()->create('gal2.jpg', 300, 'image/jpeg');

        $createResponse = $this->actingAs($this->admin)->post('/admin/projects', [
            'title_ar' => 'برج الرياض المالي التكنولوجي',
            'title_en' => 'Riyadh Financial Tech Tower',
            'description_ar' => 'توريد وتركيب شبكات وأنظمة أمنية',
            'description_en' => 'Turnkey structured cabling and security',
            'category' => 'commercial',
            'client' => 'هيئة الاستثمار',
            'location' => 'الرياض',
            'sort_order' => 10,
            'is_published' => 1,
            'cover_image' => $coverFile,
            'gallery_images' => [$galFile1, $galFile2],
        ]);

        $createResponse->assertRedirect(route('admin.projects.index'));
        $project = Project::where('title_ar', 'برج الرياض المالي التكنولوجي')->first();
        $this->assertNotNull($project);
        $this->assertNotNull($project->cover_image);
        Storage::disk('public')->assertExists($project->cover_image);

        // Verify Gallery Images Created
        $this->assertEquals(2, $project->images()->count());
        $firstImage = $project->images()->first();

        // Test Deleting Single Gallery Image
        $delImgResponse = $this->actingAs($this->admin)->delete(route('admin.projects.images.destroy', [
            'id' => $project->id,
            'imageId' => $firstImage->id
        ]));
        $delImgResponse->assertRedirect();
        $this->assertEquals(1, $project->fresh()->images()->count());

        // Test Index with filter
        $indexResponse = $this->actingAs($this->admin)->get('/admin/projects?category=commercial');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('برج الرياض المالي التكنولوجي');

        // Test Project Deletion
        $delProjResponse = $this->actingAs($this->admin)->delete(route('admin.projects.destroy', $project->id));
        $delProjResponse->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /** Test admin can filter and update quote request status */
    public function test_admin_can_manage_quotes_and_status(): void
    {
        $quote = QuoteRequest::create([
            'reference_number' => 'STS-TEST-' . rand(1000, 9999),
            'full_name' => 'Khalid Al-Otaibi',
            'email' => 'khalid.test@example.com',
            'phone' => '+966551122334',
            'project_type' => 'commercial',
            'message' => 'مشروع تركيب أنظمة أمن ومراقبة لمقر الشركة الجديد',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.quotes.show', $quote->id));
        $response->assertStatus(200);
        $response->assertSee($quote->reference_number);

        $updateResponse = $this->actingAs($this->admin)->post(route('admin.quotes.update_status', $quote->id), [
            'status' => 'contacted',
            'admin_notes' => 'تم التواصل هاتفياً وتحديد موعد للمعاينة الميدانية.',
        ]);

        $updateResponse->assertRedirect();
        $this->assertEquals('contacted', $quote->fresh()->status);
        $this->assertStringContainsString('للمعاينة الميدانية', $quote->fresh()->admin_notes);

        $quote->delete();
    }

    /** Test admin can view and delete messages */
    public function test_admin_can_manage_contact_messages(): void
    {
        $msg = ContactMessage::create([
            'name' => 'Saud Marketing',
            'email' => 'saud.test@example.com',
            'phone' => '+966540001122',
            'subject' => 'استفسار عن عقود الصيانة السنوية',
            'message' => 'نود معرفة شروط وتكاليف عقود الصيانة الدورية لمجمعاتنا.',
            'is_read' => false,
        ]);

        $showResponse = $this->actingAs($this->admin)->get(route('admin.messages.show', $msg->id));
        $showResponse->assertStatus(200);
        $this->assertTrue($msg->fresh()->is_read);

        $delResponse = $this->actingAs($this->admin)->delete(route('admin.messages.destroy', $msg->id));
        $delResponse->assertRedirect(route('admin.messages.index'));
        $this->assertDatabaseMissing('contact_messages', ['id' => $msg->id]);
    }
}
