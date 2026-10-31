<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleManagementTest extends TestCase
{
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrNew(['email' => 'admin_test_articles@sts.com.sa']);
        $this->adminUser->name = 'Article Test Admin';
        $this->adminUser->password = Hash::make('Password123!');
        $this->adminUser->is_admin = true;
        $this->adminUser->role = 'admin';
        $this->adminUser->save();
    }

    public function test_public_visitor_can_view_articles_index()
    {
        $response = $this->withSession(['locale' => 'ar'])->get(route('articles.index'));
        $response->assertStatus(200);
        $response->assertSee('المقالات');
    }

    public function test_public_visitor_can_view_single_article_and_views_increment()
    {
        $article = Article::where('is_published', true)->first();
        $this->assertNotNull($article);

        $initialViews = $article->views_count;

        $response = $this->withSession(['locale' => 'ar'])->get(route('articles.show', $article->slug));
        $response->assertStatus(200);
        $response->assertSee($article->title_ar);

        $article->refresh();
        $this->assertEquals($initialViews + 1, $article->views_count);
    }

    public function test_unauthenticated_user_cannot_access_admin_articles()
    {
        $response = $this->get(route('admin.articles.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_admin_articles_index()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.articles.index'));
        $response->assertStatus(200);
        $response->assertSee('إجمالي المقالات');
    }

    public function test_admin_can_view_create_article_page()
    {
        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.articles.create'));
        $response->assertStatus(200);
        $response->assertSee('إضافة مقال جديد');
    }

    public function test_admin_can_store_new_article_with_image_upload()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('cover_art.jpg', 300, 'image/jpeg');

        $postData = [
            'title_ar'     => 'مقال اختباري جديد للأمن السيبراني',
            'title_en'     => 'New Cybersecurity Testing Article',
            'excerpt_ar'   => 'مقتطف اختباري للمقال الجديد',
            'excerpt_en'   => 'Testing summary for the new article',
            'content_ar'   => 'محتوى تفصيلي للمقال الاختباري...',
            'content_en'   => 'Detailed test content for article...',
            'category'     => 'security',
            'author_name'  => 'م. خالد الشهري',
            'sort_order'   => 99,
            'published_at' => now()->format('Y-m-d'),
            'tags_ar'      => 'أمن, شبكات, اختبار',
            'tags_en'      => 'security, networks, testing',
            'is_published' => '1',
            'image'        => $file,
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.articles.store'), $postData);
        $response->assertRedirect(route('admin.articles.index'));

        $this->assertDatabaseHas('articles', [
            'title_ar' => 'مقال اختباري جديد للأمن السيبراني',
            'author_name' => 'م. خالد الشهري',
            'category' => 'security',
            'is_published' => true,
        ]);
    }

    public function test_admin_can_view_edit_article_page()
    {
        $article = Article::first();
        $this->assertNotNull($article);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.articles.edit', $article->id));
        $response->assertStatus(200);
        $response->assertSee($article->title_ar);
    }

    public function test_admin_can_update_article()
    {
        $article = Article::create([
            'slug'         => 'temp-test-article-' . rand(100, 999),
            'title_ar'     => 'عنوان قبل التعديل',
            'title_en'     => 'Title Before Edit',
            'excerpt_ar'   => 'مقتطف قبل التعديل',
            'excerpt_en'   => 'Excerpt Before Edit',
            'category'     => 'engineering',
            'sort_order'   => 50,
            'is_published' => false,
        ]);

        $updateData = [
            'title_ar'     => 'عنوان بعد التعديل الشامل',
            'title_en'     => 'Title After Comprehensive Edit',
            'excerpt_ar'   => 'مقتطف بعد التعديل',
            'excerpt_en'   => 'Excerpt After Edit',
            'category'     => 'iot',
            'sort_order'   => 51,
            'published_at' => now()->format('Y-m-d'),
            'tags_ar'      => 'تحديث, تجربة',
            'tags_en'      => 'update, trial',
            'is_published' => '1',
        ];

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->put(route('admin.articles.update', $article->id), $updateData);
        $response->assertRedirect(route('admin.articles.index'));

        $article->refresh();
        $this->assertEquals('عنوان بعد التعديل الشامل', $article->title_ar);
        $this->assertEquals('iot', $article->category);
        $this->assertTrue($article->is_published);

        $article->delete();
    }

    public function test_admin_can_toggle_article_publish_status()
    {
        $article = Article::create([
            'slug'         => 'toggle-test-article-' . rand(100, 999),
            'title_ar'     => 'مقال لاختبار التبديل',
            'title_en'     => 'Toggle Test Article',
            'excerpt_ar'   => 'مقتطف',
            'excerpt_en'   => 'Excerpt',
            'category'     => 'corporate',
            'sort_order'   => 1,
            'is_published' => false,
        ]);

        $this->assertFalse($article->is_published);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.articles.toggle', $article->id));
        $response->assertStatus(302);

        $article->refresh();
        $this->assertTrue($article->is_published);

        $article->delete();
    }

    public function test_admin_can_delete_article()
    {
        $article = Article::create([
            'slug'         => 'delete-test-article-' . rand(100, 999),
            'title_ar'     => 'مقال سيتم حذفه',
            'title_en'     => 'Article to be deleted',
            'excerpt_ar'   => 'مقتطف',
            'excerpt_en'   => 'Excerpt',
            'category'     => 'security',
            'sort_order'   => 1,
            'is_published' => true,
        ]);

        $articleId = $article->id;

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->delete(route('admin.articles.destroy', $articleId));
        $response->assertRedirect(route('admin.articles.index'));

        $this->assertDatabaseMissing('articles', ['id' => $articleId]);
    }

    public function test_admin_can_view_article_show_page()
    {
        $article = Article::first();
        $this->assertNotNull($article);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->get(route('admin.articles.show', $article->id));
        $response->assertStatus(200);
        $response->assertSee($article->title_ar);
        $response->assertSee('إجمالي المشاهدات');
        $response->assertSee('العودة لقائمة المقالات');
    }

    public function test_admin_can_duplicate_article()
    {
        $original = Article::first();
        $this->assertNotNull($original);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.articles.duplicate', $original->id));
        $response->assertStatus(302);

        $duplicated = Article::where('title_en', 'Copy — ' . $original->title_en)->first();
        $this->assertNotNull($duplicated);
        $this->assertFalse($duplicated->is_published);
        $this->assertEquals(0, $duplicated->views_count);

        $duplicated->delete();
    }

    public function test_admin_can_bulk_delete_articles()
    {
        $a1 = Article::create([
            'slug'         => 'bulk-test-1-' . rand(100, 999),
            'title_ar'     => 'مقال جماعي 1',
            'title_en'     => 'Bulk 1',
            'excerpt_ar'   => 'مقتطف',
            'excerpt_en'   => 'Excerpt',
            'category'     => 'corporate',
            'sort_order'   => 1,
            'is_published' => false,
        ]);
        $a2 = Article::create([
            'slug'         => 'bulk-test-2-' . rand(100, 999),
            'title_ar'     => 'مقال جماعي 2',
            'title_en'     => 'Bulk 2',
            'excerpt_ar'   => 'مقتطف',
            'excerpt_en'   => 'Excerpt',
            'category'     => 'corporate',
            'sort_order'   => 2,
            'is_published' => false,
        ]);

        $response = $this->withSession(['locale' => 'ar'])->actingAs($this->adminUser)->post(route('admin.articles.bulkDelete'), [
            'ids' => [$a1->id, $a2->id],
        ]);

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseMissing('articles', ['id' => $a1->id]);
        $this->assertDatabaseMissing('articles', ['id' => $a2->id]);
    }

    public function test_admin_can_update_article_sort_order_via_ajax()
    {
        $article = Article::first();
        $this->assertNotNull($article);

        $newSort = 88;
        $response = $this->actingAs($this->adminUser)->postJson(route('admin.articles.updateOrder'), [
            'order' => [
                ['id' => $article->id, 'sort' => $newSort],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $article->refresh();
        $this->assertEquals($newSort, $article->sort_order);
    }
}
