<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequestStoreRequest;
use App\Models\QuoteRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuoteController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $selectedServiceId = null;
        if ($request->filled('service')) {
            $service = Service::where('slug', $request->query('service'))->first();
            if ($service) {
                $selectedServiceId = $service->id;
            }
        }

        $selectedPackage = null;
        if ($request->filled('package')) {
            $selectedPackage = \App\Models\ServiceOffer::where('slug', $request->query('package'))->first();
            if ($selectedPackage && !$selectedServiceId) {
                $selectedServiceId = $selectedPackage->service_id;
            }
        }

        return view('pages.quote', compact('services', 'selectedServiceId', 'selectedPackage'));
    }

    public function store(QuoteRequestStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $attachmentPath = $file->storeAs('attachments/quotes', $filename, 'public');
            }

            $quote = DB::transaction(function () use ($validated, $attachmentPath, $request) {
                return QuoteRequest::create([
                    'reference_number' => QuoteRequest::generateReferenceNumber(),
                    'full_name' => $validated['full_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'company_name' => $validated['company_name'] ?? null,
                    'service_id' => $validated['service_id'] ?? null,
                    'project_type' => $validated['project_type'],
                    'location' => $validated['location'] ?? null,
                    'estimated_budget' => $validated['estimated_budget'] ?? null,
                    'message' => $validated['message'],
                    'attachment_path' => $attachmentPath,
                    'status' => 'pending',
                    'preferred_language' => app()->getLocale(),
                    'ip_address' => $request->ip(),
                ]);
            });

            return redirect()->route('quote.create')->with([
                'quote_success' => true,
                'reference_number' => $quote->reference_number,
                'client_name' => $quote->full_name,
            ]);

        } catch (\Exception $e) {
            Log::error('Quote request submission error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', app()->getLocale() === 'ar' 
                    ? 'حدث خطأ أثناء إرسال طلب عرض السعر، يرجى المحاولة مرة أخرى أو الاتصال بنا مباشرة.'
                    : 'An error occurred while submitting your quote request. Please try again or contact us directly.');
        }
    }
}
