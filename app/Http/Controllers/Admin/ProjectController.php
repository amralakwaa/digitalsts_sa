<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('images')->orderBy('sort_order', 'asc');

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('client', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%");
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

        $projects = $query->paginate(15)->withQueryString();

        $stats = [
            'total'     => Project::count(),
            'published' => Project::where('is_published', true)->count(),
            'draft'     => Project::where('is_published', false)->count(),
        ];

        return view('admin.projects.index', compact('projects', 'stats'));
    }

    public function create()
    {
        $nextSort = (Project::max('sort_order') ?? 0) + 1;
        return view('admin.projects.create', compact('nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar'        => ['required', 'string', 'max:200'],
            'title_en'        => ['required', 'string', 'max:200'],
            'description_ar'  => ['required', 'string'],
            'description_en'  => ['required', 'string'],
            'content_ar'      => ['nullable', 'string'],
            'content_en'      => ['nullable', 'string'],
            'category'        => ['required', 'string'],
            'client'          => ['nullable', 'string', 'max:150'],
            'location'        => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'date'],
            'sort_order'      => ['required', 'integer'],
            'cover_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_images.*'=> ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $baseSlug = Str::slug($validated['title_en']) ?: 'project';
        $slug = $baseSlug . '-' . rand(100, 999);
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . rand(100, 999);
        }
        $validated['slug'] = $slug;
        $validated['is_published'] = $request->has('is_published');

        // Handle Cover Image
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('projects', 'public');
            $validated['cover_image'] = $coverPath;
        }

        $project = Project::create($validated);

        // Handle Project Gallery Images
        if ($request->hasFile('gallery_images')) {
            $gIndex = 1;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'sort_order' => $gIndex++,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم إضافة المشروع بنجاح.'
            : 'Project added successfully.');
    }

    public function edit(int $id)
    {
        $project = Project::with('images')->findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, int $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title_ar'        => ['required', 'string', 'max:200'],
            'title_en'        => ['required', 'string', 'max:200'],
            'description_ar'  => ['required', 'string'],
            'description_en'  => ['required', 'string'],
            'content_ar'      => ['nullable', 'string'],
            'content_en'      => ['nullable', 'string'],
            'category'        => ['required', 'string'],
            'client'          => ['nullable', 'string', 'max:150'],
            'location'        => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'date'],
            'sort_order'      => ['required', 'integer'],
            'cover_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_cover'    => ['nullable', 'boolean'],
            'gallery_images.*'=> ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $validated['is_published'] = $request->has('is_published');

        // Handle Cover Image Replacement or Removal
        if ($request->boolean('remove_cover')) {
            if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = null;
        } elseif ($request->hasFile('cover_image')) {
            if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('projects', 'public');
            $validated['cover_image'] = $coverPath;
        }

        $project->update($validated);

        // Handle Additional Gallery Images
        if ($request->hasFile('gallery_images')) {
            $nextSort = (ProjectImage::where('project_id', $project->id)->max('sort_order') ?? 0) + 1;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'sort_order' => $nextSort++,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث المشروع بنجاح.'
            : 'Project updated successfully.');
    }

    public function toggle(int $id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_published' => !$project->is_published]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تعديل حالة نشر المشروع.'
            : 'Project publish status toggled.');
    }

    public function destroy(int $id)
    {
        $project = Project::with('images')->findOrFail($id);

        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        foreach ($project->images as $img) {
            if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف المشروع بنجاح.'
            : 'Project deleted successfully.');
    }

    public function destroyImage(int $projectId, int $imageId)
    {
        $img = ProjectImage::where('project_id', $projectId)->findOrFail($imageId);

        if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
            Storage::disk('public')->delete($img->image_path);
        }

        $img->delete();

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف الصورة من معرض المشروع بنجاح.'
            : 'Gallery image removed successfully.');
    }
}

