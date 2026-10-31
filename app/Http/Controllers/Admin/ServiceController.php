<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Standard list of curated security and engineering icons
     */
    protected array $availableIcons = [
        'shield-check' => 'درع الحماية والأمان (Shield Check)',
        'flame'        => 'مكافحة وإنذار الحريق (Fire Protection)',
        'video'        => 'كاميرات المراقبة CCTV (CCTV & Video)',
        'zap'          => 'أنظمة الطاقة والكهرباء (Power & Electrical)',
        'lock'         => 'التحكم بالدخول والأقفال (Access Control)',
        'cpu'          => 'الأنظمة الذكية وإنترنت الأشياء (Smart IoT & BMS)',
        'network'      => 'الشبكات والبنية التحتية (Structured Cabling & Networks)',
        'activity'     => 'الاستشعار والمراقبة البيئية (Sensors & Monitoring)',
        'server'       => 'غرف السيرفرات والبيانات (Server & Data Centers)',
        'wifi'         => 'الاتصالات اللاسلكية (Wireless Solutions)',
        'bell'         => 'أنظمة النداء والإخلاء الصوتي (Public Address & Evacuation)',
        'eye'          => 'المراقبة والتحكم الميداني (Surveillance & Control)',
    ];

    public function index(Request $request)
    {
        $query = Service::withCount('quoteRequests')->orderBy('sort_order', 'asc');

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%")
                    ->orWhere('description_en', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status') && $request->query('status') !== 'all') {
            if ($request->query('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->query('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $services = $query->get();

        $stats = [
            'total'    => Service::count(),
            'active'   => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        return view('admin.services.index', compact('services', 'stats'));
    }

    public function show(int $id)
    {
        $service = Service::with(['quoteRequests' => function ($q) {
            $q->latest()->take(10);
        }, 'offers'])->findOrFail($id);

        $stats = [
            'total_quotes'   => $service->quoteRequests()->count(),
            'pending_quotes' => $service->quoteRequests()->where('status', 'pending')->count(),
            'total_offers'   => $service->offers()->count(),
            'active_offers'  => $service->offers()->where('is_active', true)->count(),
        ];

        return view('admin.services.show', compact('service', 'stats'));
    }

    public function create()
    {
        $icons = $this->availableIcons;
        $nextSort = (Service::max('sort_order') ?? 0) + 1;
        return view('admin.services.create', compact('icons', 'nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:200'],
            'title_en'       => ['required', 'string', 'max:200'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'content_ar'     => ['nullable', 'string'],
            'content_en'     => ['nullable', 'string'],
            'icon'           => ['nullable', 'string', 'max:50'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'features_ar'    => ['nullable'],
            'features_en'    => ['nullable'],
            'benefits_ar'    => ['nullable'],
            'benefits_en'    => ['nullable'],
            'sectors_ar'     => ['nullable'],
            'sectors_en'     => ['nullable'],
        ]);

        $baseSlug = Str::slug($validated['title_en']) ?: 'service';
        $slug = $baseSlug;
        $counter = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $request->input('icon') ?: 'shield-check';

        // Process Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }

        // Process dynamic arrays
        $validated['features_ar'] = $this->parseLines($request->input('features_ar'));
        $validated['features_en'] = $this->parseLines($request->input('features_en'));
        $validated['benefits_ar'] = $this->parseLines($request->input('benefits_ar'));
        $validated['benefits_en'] = $this->parseLines($request->input('benefits_en'));
        $validated['sectors_ar']  = $this->parseLines($request->input('sectors_ar'));
        $validated['sectors_en']  = $this->parseLines($request->input('sectors_en'));

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم إضافة الخدمة الهندسية الجديدة بنجاح.'
            : 'Engineering service added successfully.');
    }

    public function edit(int $id)
    {
        $service = Service::findOrFail($id);
        $icons = $this->availableIcons;

        return view('admin.services.edit', compact('service', 'icons'));
    }

    public function update(Request $request, int $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title_ar'       => ['required', 'string', 'max:200'],
            'title_en'       => ['required', 'string', 'max:200'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'content_ar'     => ['nullable', 'string'],
            'content_en'     => ['nullable', 'string'],
            'icon'           => ['nullable', 'string', 'max:50'],
            'sort_order'     => ['required', 'integer'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'remove_image'   => ['nullable', 'boolean'],
            'features_ar'    => ['nullable'],
            'features_en'    => ['nullable'],
            'benefits_ar'    => ['nullable'],
            'benefits_en'    => ['nullable'],
            'sectors_ar'     => ['nullable'],
            'sectors_en'     => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        if (!empty($validated['icon'])) {
            $validated['icon'] = $validated['icon'];
        }

        // Handle Image Deletion or Replacement
        if ($request->boolean('remove_image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }

        // Process dynamic arrays
        $validated['features_ar'] = $this->parseLines($request->input('features_ar'));
        $validated['features_en'] = $this->parseLines($request->input('features_en'));
        $validated['benefits_ar'] = $this->parseLines($request->input('benefits_ar'));
        $validated['benefits_en'] = $this->parseLines($request->input('benefits_en'));
        $validated['sectors_ar']  = $this->parseLines($request->input('sectors_ar'));
        $validated['sectors_en']  = $this->parseLines($request->input('sectors_en'));

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حفظ وتحديث بيانات الخدمة بنجاح.'
            : 'Service updated successfully.');
    }

    public function toggle(int $id)
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تعديل حالة تفعيل الخدمة.'
            : 'Service status toggled.');
    }

    public function destroy(int $id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف الخدمة بنجاح.'
            : 'Service deleted successfully.');
    }

    /**
     * Parse textarea lines or arrays into a clean string array
     */
    protected function parseLines($input): array
    {
        if (is_array($input)) {
            return array_values(array_filter(array_map('trim', $input), fn($line) => $line !== ''));
        }

        if (empty($input) || !is_string($input)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $input)), fn($line) => $line !== ''));
    }
}

