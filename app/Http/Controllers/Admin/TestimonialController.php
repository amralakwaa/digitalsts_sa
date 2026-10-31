<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::orderBy('sort_order', 'asc')->latest('id');

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('client_name', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('project_type', 'like', "%{$q}%")
                    ->orWhere('review_text', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status') && $request->query('status') !== 'all') {
            if ($request->query('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->query('status') === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->query('status') === 'featured') {
                $query->where('is_featured', true);
            }
        }

        if ($request->filled('rating') && $request->query('rating') !== 'all') {
            $query->where('rating', (int) $request->query('rating'));
        }

        $testimonials = $query->paginate(12)->withQueryString();

        $stats = [
            'total'     => Testimonial::count(),
            'active'    => Testimonial::where('is_active', true)->count(),
            'featured'  => Testimonial::where('is_featured', true)->count(),
            'avg_rating'=> round(Testimonial::avg('rating') ?: 5, 1),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    public function create()
    {
        $nextSort = (Testimonial::max('sort_order') ?? 0) + 1;
        return view('admin.testimonials.create', compact('nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'     => ['required', 'string', 'max:150'],
            'client_position' => ['nullable', 'string', 'max:150'],
            'company'         => ['nullable', 'string', 'max:150'],
            'city'            => ['nullable', 'string', 'max:100'],
            'project_type'    => ['nullable', 'string', 'max:150'],
            'rating'          => ['required', 'integer', 'min:1', 'max:5'],
            'review_text'     => ['required', 'string'],
            'review_text_en'  => ['nullable', 'string'],
            'avatar'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'sort_order'      => ['required', 'integer'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar'] = $path;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم إضافة تقييم العميل بنجاح.'
            : 'Client testimonial added successfully.');
    }

    public function edit(int $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, int $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'client_name'     => ['required', 'string', 'max:150'],
            'client_position' => ['nullable', 'string', 'max:150'],
            'company'         => ['nullable', 'string', 'max:150'],
            'city'            => ['nullable', 'string', 'max:100'],
            'project_type'    => ['nullable', 'string', 'max:150'],
            'rating'          => ['required', 'integer', 'min:1', 'max:5'],
            'review_text'     => ['required', 'string'],
            'review_text_en'  => ['nullable', 'string'],
            'avatar'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_avatar'   => ['nullable', 'boolean'],
            'sort_order'      => ['required', 'integer'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->boolean('remove_avatar')) {
            if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = null;
        } elseif ($request->hasFile('avatar')) {
            if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar'] = $path;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث تقييم العميل بنجاح.'
            : 'Client testimonial updated successfully.');
    }

    public function toggle(int $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث حالة الظهور.'
            : 'Visibility status toggled.');
    }

    public function toggleFeatured(int $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث حالة التمييز في الصفحة الرئيسية.'
            : 'Featured status toggled.');
    }

    public function destroy(int $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف التقييم بنجاح.'
            : 'Testimonial deleted successfully.');
    }
}
