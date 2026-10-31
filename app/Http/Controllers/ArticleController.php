<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->recent();

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('excerpt_ar', 'like', "%{$q}%")
                    ->orWhere('excerpt_en', 'like', "%{$q}%")
                    ->orWhere('content_ar', 'like', "%{$q}%");
            });
        }

        $articles = $query->paginate(9)->withQueryString();

        $categories = [
            'engineering' => ['label_ar' => 'حلول هندسية', 'label_en' => 'Engineering Solutions', 'count' => Article::published()->where('category', 'engineering')->count()],
            'fire_safety' => ['label_ar' => 'السلامة ومكافحة الحريق', 'label_en' => 'Fire & Safety', 'count' => Article::published()->where('category', 'fire_safety')->count()],
            'security'    => ['label_ar' => 'الأنظمة الأمنية والمراقبة', 'label_en' => 'Security & CCTV', 'count' => Article::published()->where('category', 'security')->count()],
            'iot'         => ['label_ar' => 'التقنيات الذكية وإنترنت الأشياء', 'label_en' => 'Smart IoT & BMS', 'count' => Article::published()->where('category', 'iot')->count()],
            'corporate'   => ['label_ar' => 'أخبار ومستجدات المنصة', 'label_en' => 'Corporate News', 'count' => Article::published()->where('category', 'corporate')->count()],
        ];

        $featuredArticle = Article::published()->recent()->first();

        return view('pages.articles.index', compact('articles', 'categories', 'featuredArticle'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Increment views
        $article->increment('views_count');

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->take(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::published()
                ->where('id', '!=', $article->id)
                ->recent()
                ->take(3)
                ->get();
        }

        return view('pages.articles.show', compact('article', 'relatedArticles'));
    }
}
