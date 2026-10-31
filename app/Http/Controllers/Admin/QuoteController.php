<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class QuoteController extends Controller
{
    protected array $projectTypes = [
        'commercial'  => ['ar' => 'منشأة تجارية / مجمع أعمال', 'en' => 'Commercial / Business Complex'],
        'industrial'  => ['ar' => 'منشأة صناعية / مصنع أو مستودع', 'en' => 'Industrial / Factory / Warehouse'],
        'residential' => ['ar' => 'مجمع سكني / قصر أو فيلا خاصة', 'en' => 'Residential / Compound / Villa'],
        'governmental'=> ['ar' => 'جهة حكومية / مشروع وطني', 'en' => 'Governmental / Public Sector'],
        'hospitality' => ['ar' => 'فندق / منتجع سياحي أو ضيافة', 'en' => 'Hotel / Hospitality / Resort'],
        'healthcare'  => ['ar' => 'مستشفى / مركز رعاية صحية', 'en' => 'Healthcare / Hospital'],
        'datacenter'  => ['ar' => 'مركز بيانات / غرفة سيرفرات', 'en' => 'Data Center / Mission Critical'],
        'other'       => ['ar' => 'أخرى / متطلبات خاصة', 'en' => 'Other / Custom Solution'],
    ];

    public function index(Request $request)
    {
        $query = QuoteRequest::with('service');

        // Status Filter
        if ($request->filled('status') && $request->query('status') !== 'all') {
            $query->where('status', $request->query('status'));
        }

        // Service Filter
        if ($request->filled('service_id') && $request->query('service_id') !== 'all') {
            $query->where('service_id', $request->query('service_id'));
        }

        // Project Type Filter
        if ($request->filled('project_type') && $request->query('project_type') !== 'all') {
            $query->where('project_type', $request->query('project_type'));
        }

        // Date Range Filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->query('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->query('date_to'));
        }

        // Search Query
        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('reference_number', 'like', "%{$q}%")
                    ->orWhere('full_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('company_name', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('message', 'like', "%{$q}%")
                    ->orWhere('admin_notes', 'like', "%{$q}%");
            });
        }

        $quotes = $query->latest()->paginate(15)->withQueryString();
        $services = Service::where('is_active', true)->get();

        $statusCounts = [
            'all'          => QuoteRequest::count(),
            'pending'      => QuoteRequest::where('status', 'pending')->count(),
            'under_review' => QuoteRequest::where('status', 'under_review')->count(),
            'contacted'    => QuoteRequest::where('status', 'contacted')->count(),
            'completed'    => QuoteRequest::where('status', 'completed')->count(),
            'cancelled'    => QuoteRequest::where('status', 'cancelled')->count(),
        ];

        $kpis = [
            'total'           => $statusCounts['all'],
            'pending'         => $statusCounts['pending'],
            'in_progress'     => $statusCounts['under_review'] + $statusCounts['contacted'],
            'completed'       => $statusCounts['completed'],
            'conversion_rate' => $statusCounts['all'] > 0 ? round(($statusCounts['completed'] / $statusCounts['all']) * 100, 1) : 0,
        ];

        $projectTypes = $this->projectTypes;

        return view('admin.quotes.index', compact('quotes', 'services', 'statusCounts', 'kpis', 'projectTypes'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $projectTypes = $this->projectTypes;
        $suggestedRef = QuoteRequest::generateReferenceNumber();

        return view('admin.quotes.create', compact('services', 'projectTypes', 'suggestedRef'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number'   => ['nullable', 'string', 'max:50', 'unique:quote_requests,reference_number'],
            'full_name'          => ['required', 'string', 'max:150'],
            'email'              => ['required', 'email', 'max:150'],
            'phone'              => ['required', 'string', 'max:50'],
            'company_name'       => ['nullable', 'string', 'max:150'],
            'service_id'         => ['nullable', 'exists:services,id'],
            'project_type'       => ['required', 'string', 'max:100'],
            'location'           => ['nullable', 'string', 'max:150'],
            'estimated_budget'   => ['nullable', 'string', 'max:100'],
            'message'            => ['required', 'string', 'max:3000'],
            'status'             => ['required', 'in:pending,under_review,contacted,completed,cancelled'],
            'admin_notes'        => ['nullable', 'string', 'max:2000'],
            'attachment'         => ['nullable', 'file', 'mimes:pdf,doc,docx,zip,png,jpg,jpeg', 'max:10240'],
        ]);

        if (empty($validated['reference_number'])) {
            $validated['reference_number'] = QuoteRequest::generateReferenceNumber();
        }

        $validated['preferred_language'] = app()->getLocale();
        $validated['ip_address'] = $request->ip();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('quotes', 'public');
            $validated['attachment_path'] = $path;
        }

        $quote = QuoteRequest::create($validated);

        return redirect()->route('admin.quotes.show', $quote->id)->with('success', app()->getLocale() === 'ar'
            ? "تم إنشاء طلب عرض السعر برقم مرجعي: {$quote->reference_number} بنجاح."
            : "Quote request #{$quote->reference_number} created successfully.");
    }

    public function show(int $id)
    {
        $quote = QuoteRequest::with('service')->findOrFail($id);
        $projectTypes = $this->projectTypes;

        return view('admin.quotes.show', compact('quote', 'projectTypes'));
    }

    public function edit(int $id)
    {
        $quote = QuoteRequest::with('service')->findOrFail($id);
        $services = Service::where('is_active', true)->get();
        $projectTypes = $this->projectTypes;

        return view('admin.quotes.edit', compact('quote', 'services', 'projectTypes'));
    }

    public function update(Request $request, int $id)
    {
        $quote = QuoteRequest::findOrFail($id);

        $validated = $request->validate([
            'full_name'        => ['required', 'string', 'max:150'],
            'email'            => ['required', 'email', 'max:150'],
            'phone'            => ['required', 'string', 'max:50'],
            'company_name'     => ['nullable', 'string', 'max:150'],
            'service_id'       => ['nullable', 'exists:services,id'],
            'project_type'     => ['required', 'string', 'max:100'],
            'location'         => ['nullable', 'string', 'max:150'],
            'estimated_budget' => ['nullable', 'string', 'max:100'],
            'message'          => ['required', 'string', 'max:3000'],
            'status'           => ['required', 'in:pending,under_review,contacted,completed,cancelled'],
            'admin_notes'      => ['nullable', 'string', 'max:2000'],
            'attachment'       => ['nullable', 'file', 'mimes:pdf,doc,docx,zip,png,jpg,jpeg', 'max:10240'],
            'remove_attachment'=> ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_attachment')) {
            if ($quote->attachment_path && Storage::disk('public')->exists($quote->attachment_path)) {
                Storage::disk('public')->delete($quote->attachment_path);
            }
            $validated['attachment_path'] = null;
        } elseif ($request->hasFile('attachment')) {
            if ($quote->attachment_path && Storage::disk('public')->exists($quote->attachment_path)) {
                Storage::disk('public')->delete($quote->attachment_path);
            }
            $path = $request->file('attachment')->store('quotes', 'public');
            $validated['attachment_path'] = $path;
        }

        $quote->update($validated);

        return redirect()->route('admin.quotes.show', $quote->id)->with('success', app()->getLocale() === 'ar'
            ? 'تم حفظ وتحديث بيانات طلب عرض السعر بنجاح.'
            : 'Quote request details updated successfully.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status'      => ['required', 'in:pending,under_review,contacted,completed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $quote = QuoteRequest::findOrFail($id);
        $quote->update($validated);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث حالة طلب عرض السعر والملاحظات بنجاح.'
            : 'Quote request status updated successfully.');
    }

    public function quickStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,under_review,contacted,completed,cancelled'],
        ]);

        $quote = QuoteRequest::findOrFail($id);
        $quote->update(['status' => $validated['status']]);

        return response()->json([
            'success'     => true,
            'status'      => $quote->status,
            'label'       => $quote->status_label,
            'badge_class' => $quote->status_badge_class,
            'message'     => app()->getLocale() === 'ar' ? 'تم تحديث الحالة بنجاح.' : 'Status updated successfully.',
        ]);
    }

    public function bulkStatus(Request $request)
    {
        $validated = $request->validate([
            'ids'    => ['required', 'array', 'min:1'],
            'ids.*'  => ['integer', 'exists:quote_requests,id'],
            'status' => ['required', 'in:pending,under_review,contacted,completed,cancelled'],
        ]);

        QuoteRequest::whereIn('id', $validated['ids'])->update(['status' => $validated['status']]);

        $count = count($validated['ids']);
        return redirect()->route('admin.quotes.index')->with('success', app()->getLocale() === 'ar'
            ? "تم تحديث حالة {$count} طلب بنجاح."
            : "Status updated for {$count} quote request(s).");
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids'   => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:quote_requests,id'],
        ]);

        $quotes = QuoteRequest::whereIn('id', $validated['ids'])->get();

        foreach ($quotes as $quote) {
            if ($quote->attachment_path && Storage::disk('public')->exists($quote->attachment_path)) {
                Storage::disk('public')->delete($quote->attachment_path);
            }
            $quote->delete();
        }

        $count = count($validated['ids']);
        return redirect()->route('admin.quotes.index')->with('success', app()->getLocale() === 'ar'
            ? "تم حذف {$count} طلب عرض سعر نهائياً."
            : "{$count} quote request(s) deleted successfully.");
    }

    public function export(Request $request): StreamedResponse
    {
        $query = QuoteRequest::with('service');

        if ($request->filled('status') && $request->query('status') !== 'all') {
            $query->where('status', $request->query('status'));
        }
        if ($request->filled('service_id') && $request->query('service_id') !== 'all') {
            $query->where('service_id', $request->query('service_id'));
        }
        if ($request->filled('project_type') && $request->query('project_type') !== 'all') {
            $query->where('project_type', $request->query('project_type'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->query('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->query('date_to'));
        }
        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('reference_number', 'like', "%{$q}%")
                    ->orWhere('full_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('company_name', 'like', "%{$q}%");
            });
        }

        $quotes = $query->latest()->get();

        $filename = 'STS_Quotes_Export_' . date('Y-m-d_His') . '.csv';

        return response()->streamDownload(function () use ($quotes) {
            $handle = fopen('php://output', 'w');
            // Write UTF-8 BOM so Microsoft Excel opens Arabic without encoding issues
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'الرقم المرجعي',
                'اسم العميل',
                'البريد الإلكتروني',
                'الهاتف',
                'اسم الشركة / المنشأة',
                'الخدمة المطلوبة',
                'نوع المشروع',
                'الموقع / المدينة',
                'الميزانية التقديرية',
                'الحالة الحالية',
                'تاريخ الطلب',
                'ملاحظات الإدارة',
                'نص الرسالة',
            ]);

            foreach ($quotes as $quote) {
                fputcsv($handle, [
                    $quote->reference_number,
                    $quote->full_name,
                    $quote->email,
                    $quote->phone,
                    $quote->company_name ?: '—',
                    $quote->service ? $quote->service->title : 'عام',
                    $quote->project_type,
                    $quote->location ?: '—',
                    $quote->estimated_budget ?: '—',
                    $quote->status_label,
                    $quote->created_at->format('Y-m-d H:i'),
                    $quote->admin_notes ?: '—',
                    $quote->message,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function downloadAttachment(int $id)
    {
        $quote = QuoteRequest::findOrFail($id);

        if (!$quote->attachment_path || !Storage::disk('public')->exists($quote->attachment_path)) {
            abort(404, 'Attachment file not found.');
        }

        return Storage::disk('public')->download($quote->attachment_path);
    }

    public function destroy(int $id)
    {
        $quote = QuoteRequest::findOrFail($id);

        if ($quote->attachment_path && Storage::disk('public')->exists($quote->attachment_path)) {
            Storage::disk('public')->delete($quote->attachment_path);
        }

        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف طلب عرض السعر بنجاح.'
            : 'Quote request deleted successfully.');
    }
}
