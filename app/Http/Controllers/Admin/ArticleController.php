<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    protected array $categories = [
        'engineering' => 'حلول واستشارات هندسية (Engineering Solutions)',
        'fire_safety' => 'السلامة ومكافحة الحريق (Fire Protection)',
        'security'    => 'الأنظمة الأمنية والمراقبة (Security & CCTV)',
        'iot'         => 'التقنيات الذكية وإنترنت الأشياء (Smart IoT & BMS)',
        'corporate'   => 'أخبار ومستجدات المنصة (Corporate News)',
    ];

    public function index(Request $request)
    {
        $query = Article::orderBy('sort_order', 'asc')->latest();

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('excerpt_ar', 'like', "%{$q}%")
                    ->orWhere('author_name', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        if ($request->filled('status') && $request->query('status') !== 'all') {
            if ($request->query('status') === 'published') {
                $query->where('is_published', true);
            } elseif ($request->query('status') === 'draft') {
                $query->where('is_published', false);
            }
        }

        $articles = $query->paginate(15)->withQueryString();

        $stats = [
            'total'       => Article::count(),
            'published'   => Article::where('is_published', true)->count(),
            'draft'       => Article::where('is_published', false)->count(),
            'total_views' => Article::sum('views_count'),
        ];

        $categories = $this->categories;

        return view('admin.articles.index', compact('articles', 'stats', 'categories'));
    }

    public function show(int $id)
    {
        $article = Article::findOrFail($id);
        $categories = $this->categories;

        // Calculate article-specific stats
        $categoryCount = Article::where('category', $article->category)->count();
        $avgViews = (int) Article::avg('views_count');
        $rankInCategory = Article::where('category', $article->category)
            ->where('views_count', '>', $article->views_count)
            ->count() + 1;

        return view('admin.articles.show', compact('article', 'categories', 'categoryCount', 'avgViews', 'rankInCategory'));
    }

    public function create()
    {
        $categories = $this->categories;
        $nextSort = (Article::max('sort_order') ?? 0) + 1;
        return view('admin.articles.create', compact('categories', 'nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:250'],
            'title_en'       => ['required', 'string', 'max:250'],
            'excerpt_ar'     => ['required', 'string', 'max:500'],
            'excerpt_en'     => ['required', 'string', 'max:500'],
            'content_ar'     => ['nullable', 'string'],
            'content_en'     => ['nullable', 'string'],
            'category'       => ['required', 'string', 'max:50'],
            'author_name'    => ['nullable', 'string', 'max:150'],
            'published_at'   => ['nullable', 'date'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'tags_ar'        => ['nullable'],
            'tags_en'        => ['nullable'],
        ]);

        $baseSlug = Str::slug($validated['title_en']) ?: 'article';
        $slug = $baseSlug . '-' . rand(100, 999);
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . rand(100, 999);
        }
        $validated['slug'] = $slug;
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['published_at'] ?: now();
        $validated['author_name'] = $validated['author_name'] ?: 'فريق STS الهندسي';

        // Process Image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $validated['image'] = $path;
        }

        // Process Tags (comma or newline separated)
        $validated['tags_ar'] = $this->parseTags($request->input('tags_ar'));
        $validated['tags_en'] = $this->parseTags($request->input('tags_en'));

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حفظ ونشر المقال بنجاح.'
            : 'Article created successfully.');
    }

    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        $categories = $this->categories;

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:250'],
            'title_en'       => ['required', 'string', 'max:250'],
            'excerpt_ar'     => ['required', 'string', 'max:500'],
            'excerpt_en'     => ['required', 'string', 'max:500'],
            'content_ar'     => ['nullable', 'string'],
            'content_en'     => ['nullable', 'string'],
            'category'       => ['required', 'string', 'max:50'],
            'author_name'    => ['nullable', 'string', 'max:150'],
            'published_at'   => ['nullable', 'date'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_image'   => ['nullable', 'boolean'],
            'tags_ar'        => ['nullable'],
            'tags_en'        => ['nullable'],
        ]);

        $validated['is_published'] = $request->has('is_published');

        // Handle Image Deletion or Replacement
        if ($request->boolean('remove_image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $path = $request->file('image')->store('articles', 'public');
            $validated['image'] = $path;
        }

        // Process Tags
        $validated['tags_ar'] = $this->parseTags($request->input('tags_ar'));
        $validated['tags_en'] = $this->parseTags($request->input('tags_en'));

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث بيانات المقال بنجاح.'
            : 'Article updated successfully.');
    }

    public function toggle(int $id)
    {
        $article = Article::findOrFail($id);
        $article->update(['is_published' => !$article->is_published]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تعديل حالة نشر المقال.'
            : 'Article publish status toggled.');
    }

    public function duplicate(int $id)
    {
        $article = Article::findOrFail($id);

        $baseSlug = Str::slug($article->title_en . ' copy') ?: 'article-copy';
        $slug = $baseSlug . '-' . rand(100, 999);
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . rand(100, 999);
        }

        $newArticle = $article->replicate();
        $newArticle->slug = $slug;
        $newArticle->title_ar = (app()->getLocale() === 'ar' ? 'نسخة — ' : 'Copy — ') . $article->title_ar;
        $newArticle->title_en = 'Copy — ' . $article->title_en;
        $newArticle->is_published = false;
        $newArticle->views_count = 0;
        $newArticle->sort_order = (Article::max('sort_order') ?? 0) + 1;
        $newArticle->published_at = now();
        $newArticle->save();

        return redirect()->route('admin.articles.edit', $newArticle->id)->with('success', app()->getLocale() === 'ar'
            ? 'تم تكرار المقال بنجاح كمسودة جديدة. عدّل البيانات ثم انشر.'
            : 'Article duplicated as a new draft. Edit and publish when ready.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids'   => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:articles,id'],
        ]);

        $articles = Article::whereIn('id', $request->input('ids'))->get();

        foreach ($articles as $article) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $article->delete();
        }

        $count = count($request->input('ids'));

        return redirect()->route('admin.articles.index')->with('success', app()->getLocale() === 'ar'
            ? "تم حذف {$count} مقال بنجاح."
            : "{$count} article(s) deleted successfully.");
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'        => ['required', 'array'],
            'order.*.id'   => ['required', 'integer', 'exists:articles,id'],
            'order.*.sort' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->input('order') as $item) {
            Article::where('id', $item['id'])->update(['sort_order' => $item['sort']]);
        }

        return response()->json([
            'success' => true,
            'message' => app()->getLocale() === 'ar' ? 'تم تحديث الترتيب بنجاح.' : 'Sort order updated successfully.',
        ]);
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف المقال بنجاح.'
            : 'Article deleted successfully.');
    }

    protected function parseTags($input): array
    {
        if (is_array($input)) {
            return array_values(array_filter(array_map('trim', $input)));
        }

        if (empty($input) || !is_string($input)) {
            return [];
        }

        $items = preg_split('/[\r\n,،]+/u', (string) $input);
        return array_values(array_filter(array_map('trim', $items), fn($tag) => $tag !== ''));
    }
}
