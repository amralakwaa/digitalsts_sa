<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('is_active', true);

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%")
                    ->orWhere('description_en', 'like', "%{$q}%");
            });
        }

        $services = $query->orderBy('sort_order', 'asc')->get();

        // Featured offers across all services
        $featuredOffers = \App\Models\ServiceOffer::with('service')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        // All active offers for the full section
        $allOffers = \App\Models\ServiceOffer::with('service')
            ->where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.services.index', compact('services', 'featuredOffers', 'allOffers'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        $offers = $service->offers()
            ->where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.services.show', compact('service', 'relatedServices', 'offers'));
    }
}
