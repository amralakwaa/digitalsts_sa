<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceOfferController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceOffer::with('service')->orderBy('sort_order', 'asc')->latest();

        // Service Filter
        if ($request->filled('service_id') && $request->query('service_id') !== 'all') {
            $query->where('service_id', $request->query('service_id'));
        }

        // Status Filter
        if ($request->filled('status') && $request->query('status') !== 'all') {
            if ($request->query('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->query('status') === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->query('status') === 'featured') {
                $query->where('is_featured', true);
            }
        }

        // Search Query
        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('badge_text_ar', 'like', "%{$q}%")
                    ->orWhere('badge_text_en', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%");
            });
        }

        $offers = $query->paginate(12)->withQueryString();
        $services = Service::where('is_active', true)->get();

        $stats = [
            'total'    => ServiceOffer::count(),
            'active'   => ServiceOffer::where('is_active', true)->count(),
            'inactive' => ServiceOffer::where('is_active', false)->count(),
            'featured' => ServiceOffer::where('is_featured', true)->count(),
        ];

        return view('admin.service_offers.index', compact('offers', 'services', 'stats'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $nextSort = (ServiceOffer::max('sort_order') ?? 0) + 1;

        return view('admin.service_offers.create', compact('services', 'nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:250'],
            'title_en'       => ['required', 'string', 'max:250'],
            'service_id'     => ['nullable', 'exists:services,id'],
            'badge_text_ar'  => ['nullable', 'string', 'max:100'],
            'badge_text_en'  => ['nullable', 'string', 'max:100'],
            'description_ar' => ['nullable', 'string', 'max:1000'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'price'          => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'currency'       => ['nullable', 'string', 'max:10'],
            'billing_period' => ['required', 'in:project,monthly,annually,one_time'],
            'features_ar'    => ['nullable'],
            'features_en'    => ['nullable'],
            'is_featured'    => ['nullable', 'boolean'],
            'is_active'      => ['nullable', 'boolean'],
            'valid_until'    => ['nullable', 'date'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $baseSlug = Str::slug($validated['title_en']) ?: 'service-package';
        $slug = $baseSlug . '-' . rand(100, 999);
        while (ServiceOffer::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . rand(100, 999);
        }
        $validated['slug'] = $slug;

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['currency'] = $validated['currency'] ?: 'SAR';

        // Parse features
        $validated['features_ar'] = $this->parseLines($request->input('features_ar'));
        $validated['features_en'] = $this->parseLines($request->input('features_en'));

        // Handle Image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('service_offers', 'public');
            $validated['image'] = $path;
        }

        $offer = ServiceOffer::create($validated);

        return redirect()->route('admin.service-offers.show', $offer->id)->with('success', app()->getLocale() === 'ar'
            ? 'تم إنشاء باقة عرض الخدمة بنجاح.'
            : 'Service package created successfully.');
    }

    public function show(int $id)
    {
        $offer = ServiceOffer::with('service')->findOrFail($id);

        return view('admin.service_offers.show', compact('offer'));
    }

    public function edit(int $id)
    {
        $offer = ServiceOffer::findOrFail($id);
        $services = Service::where('is_active', true)->get();

        return view('admin.service_offers.edit', compact('offer', 'services'));
    }

    public function update(Request $request, int $id)
    {
        $offer = ServiceOffer::findOrFail($id);

        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:250'],
            'title_en'       => ['required', 'string', 'max:250'],
            'service_id'     => ['nullable', 'exists:services,id'],
            'badge_text_ar'  => ['nullable', 'string', 'max:100'],
            'badge_text_en'  => ['nullable', 'string', 'max:100'],
            'description_ar' => ['nullable', 'string', 'max:1000'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'price'          => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'currency'       => ['nullable', 'string', 'max:10'],
            'billing_period' => ['required', 'in:project,monthly,annually,one_time'],
            'features_ar'    => ['nullable'],
            'features_en'    => ['nullable'],
            'is_featured'    => ['nullable', 'boolean'],
            'is_active'      => ['nullable', 'boolean'],
            'valid_until'    => ['nullable', 'date'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_image'   => ['nullable', 'boolean'],
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['currency'] = $validated['currency'] ?: 'SAR';

        // Parse features
        $validated['features_ar'] = $this->parseLines($request->input('features_ar'));
        $validated['features_en'] = $this->parseLines($request->input('features_en'));

        // Handle Image
        if ($request->boolean('remove_image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $path = $request->file('image')->store('service_offers', 'public');
            $validated['image'] = $path;
        }

        $offer->update($validated);

        return redirect()->route('admin.service-offers.show', $offer->id)->with('success', app()->getLocale() === 'ar'
            ? 'تم حفظ وتحديث باقة العرض بنجاح.'
            : 'Service package updated successfully.');
    }

    public function toggle(int $id)
    {
        $offer = ServiceOffer::findOrFail($id);
        $offer->update(['is_active' => !$offer->is_active]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تعديل حالة تفعيل باقة العرض.'
            : 'Service package activation status toggled.');
    }

    public function toggleFeatured(int $id)
    {
        $offer = ServiceOffer::findOrFail($id);
        $offer->update(['is_featured' => !$offer->is_featured]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تعديل تمييز باقة العرض.'
            : 'Service package featured status toggled.');
    }

    public function destroy(int $id)
    {
        $offer = ServiceOffer::findOrFail($id);

        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }

        $offer->delete();

        return redirect()->route('admin.service-offers.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف باقة العرض بنجاح.'
            : 'Service package deleted successfully.');
    }

    protected function parseLines($input): array
    {
        if (is_array($input)) {
            return array_values(array_filter(array_map('trim', $input)));
        }

        if (empty($input) || !is_string($input)) {
            return [];
        }

        $items = preg_split('/[\r\n]+/u', (string) $input);
        return array_values(array_filter(array_map('trim', $items), fn($line) => $line !== ''));
    }
}
