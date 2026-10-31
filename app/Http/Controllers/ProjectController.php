<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('images')->where('is_published', true);

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        $projects = $query->orderBy('sort_order', 'asc')
            ->orderBy('completion_date', 'desc')
            ->paginate(9);

        $currentCategory = $request->query('category', 'all');

        $galleryQuery = \App\Models\ProjectImage::whereHas('project', function ($q) {
            $q->where('is_published', true);
        })->with('project');

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $galleryQuery->whereHas('project', function ($q) use ($request) {
                $q->where('category', $request->query('category'));
            });
        }

        $galleryImages = $galleryQuery->orderBy('sort_order', 'asc')->get();

        return view('pages.projects.index', compact('projects', 'currentCategory', 'galleryImages'));
    }

    public function show(string $slug)
    {
        $project = Project::with('images')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedProjects = Project::where('is_published', true)
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->take(3)
            ->get();

        if ($relatedProjects->isEmpty()) {
            $relatedProjects = Project::where('is_published', true)
                ->where('id', '!=', $project->id)
                ->take(3)
                ->get();
        }

        return view('pages.projects.show', compact('project', 'relatedProjects'));
    }
}
