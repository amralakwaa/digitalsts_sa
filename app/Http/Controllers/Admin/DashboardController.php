<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\Service;
use App\Models\Project;
use App\Models\ContactMessage;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_quotes' => QuoteRequest::count(),
            'pending_quotes' => QuoteRequest::where('status', 'pending')->count(),
            'under_review_quotes' => QuoteRequest::where('status', 'under_review')->count(),
            'completed_quotes' => QuoteRequest::where('status', 'completed')->count(),
            'total_services' => Service::count(),
            'total_projects' => Project::count(),
            'total_articles' => Article::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentQuotes = QuoteRequest::with('service')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentQuotes'));
    }
}
