<?php

namespace App\Http\Controllers;

use App\Models\ServiceOffer;
use App\Models\Service;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of active promotional packages & offers.
     */
    public function index(Request $request)
    {
        $query = ServiceOffer::with('service')->where('is_active', true);

        // Filter by service if provided
        if ($request->filled('service')) {
            $serviceSlug = $request->query('service');
            $query->whereHas('service', function ($q) use ($serviceSlug) {
                $q->where('slug', $serviceSlug);
            });
        }

        // Search by title or description
        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%")
                    ->orWhere('description_en', 'like', "%{$q}%");
            });
        }

        $offers = $query->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get();

        $services = Service::where('is_active', true)
            ->whereHas('offers', function ($q) {
                $q->where('is_active', true);
            })
            ->get();

        return view('pages.offers.index', compact('offers', 'services'));
    }

    /**
     * Display a single dedicated offer page.
     */
    public function show(string $slug)
    {
        $offer = ServiceOffer::with('service')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Related packages (either same service or other featured packages)
        $relatedOffers = ServiceOffer::with('service')
            ->where('is_active', true)
            ->where('id', '!=', $offer->id)
            ->when($offer->service_id, function ($q) use ($offer) {
                $q->orderByRaw("service_id = {$offer->service_id} DESC");
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        return view('pages.offers.show', compact('offer', 'relatedOffers'));
    }
}
