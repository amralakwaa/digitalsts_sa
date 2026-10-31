@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إدارة عروض وباقات الخدمات' : 'Manage Service Packages & Offers') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إدارة عروض وباقات الخدمات' : 'Service Packages & Deals')

@section('content')

<div class="space-y-6">

    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Packages -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-brand-100 group hover:border-brand-300 transition-all">
            <div>
                <span class="text-[11px] text-surface-400 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الباقات والعروض' : 'Total Packages' }}
                </span>
                <span class="text-2xl font-black text-surface-900 font-outfit">{{ $stats['total'] }}</span>
                <span class="text-[10px] text-surface-400 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'العروض الهندسية المسجلة' : 'All packages in catalog' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>

        <!-- Active Packages -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-[11px] text-emerald-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'باقات مفعلة ومتاحة' : 'Active Offers' }}
                </span>
                <span class="text-2xl font-black text-emerald-600 font-outfit">{{ $stats['active'] }}</span>
                <span class="text-[10px] text-emerald-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'متاحة للطلب عبر الموقع' : 'Visible to public' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Featured Deals -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-[11px] text-amber-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'عروض مميزة وخصومات' : 'Featured Deals' }}
                </span>
                <span class="text-2xl font-black text-amber-600 font-outfit">{{ $stats['featured'] }}</span>
                <span class="text-[10px] text-amber-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تحمل شارات ترويجية' : 'Promoted with badges' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
        </div>

        <!-- Inactive Offers -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-rose-100 group hover:border-rose-300 transition-all">
            <div>
                <span class="text-[11px] text-rose-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'باقات معطلة مؤقتاً' : 'Inactive Packages' }}
                </span>
                <span class="text-2xl font-black text-rose-600 font-outfit">{{ $stats['inactive'] }}</span>
                <span class="text-[10px] text-rose-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'مخفية من العرض' : 'Draft / Archived' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Action Bar -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">
                    {{ app()->getLocale() === 'ar' ? 'قائمة عروض وباقات الخدمات الهندسية' : 'Service Packages & Engineering Deals Directory' }}
                </h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'تخصيص الباقات الترويجية، الأسعار، المميزات، الخصومات المعتمدة لعملاء الشركات والأفراد' : 'Manage turnkey packages, itemized features, pricing models, and active promotions' }}
                </span>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.service-offers.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'إضافة باقة / عرض جديد' : 'New Package' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.service-offers.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'بحث باسم الباقة أو الشارة أو الوصف...' : 'Search packages by title, badge, or description...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Service Filter -->
                <div class="w-48">
                    <select name="service_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع الخدمات' : 'All Services' }}</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ request('service_id') == $srv->id ? 'selected' : '' }}>
                                {{ $srv->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="w-36">
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ !request('status') || request('status') === 'all' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'كل الحالات' : 'All Status' }}</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المفعلة فقط' : 'Active Only' }}</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المعطلة' : 'Inactive' }}</option>
                        <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المميزة فقط' : 'Featured Only' }}</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary text-xs py-2 px-3.5">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request('q') || request('service_id') || request('status'))
                    <a href="{{ route('admin.service-offers.index') }}" class="btn-secondary text-xs py-2 px-3 text-rose-600 hover:bg-rose-50 border-rose-200">
                        ✕
                    </a>
                @endif
            </form>
        </div>

        <!-- Package Grid Display -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($offers as $offer)
                    <div class="card-light rounded-3xl p-6 border {{ $offer->is_featured ? 'border-brand-300 ring-2 ring-brand-500/10 shadow-soft' : 'border-surface-200' }} flex flex-col justify-between group hover:shadow-lg transition-all relative overflow-hidden">
                        
                        <!-- Top Accent Line -->
                        @if($offer->is_featured)
                            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-brand-600 via-indigo-600 to-brand-500"></div>
                        @endif

                        <div class="space-y-4">
                            <!-- Badge & Actions -->
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    @if($offer->badge_text)
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-200">
                                            {{ $offer->badge_text }}
                                        </span>
                                    @endif
                                    @if($offer->discount_percentage)
                                        <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-rose-50 text-rose-700 border border-rose-200 font-mono">
                                            -{{ $offer->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                <!-- Toggle Actions -->
                                <div class="flex items-center gap-1">
                                    <!-- Star / Featured Toggle -->
                                    <form action="{{ route('admin.service-offers.featured', $offer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="{{ $offer->is_featured ? 'إلغاء التمييز' : 'تمييز الباقة' }}"
                                                class="p-1.5 rounded-lg transition-colors {{ $offer->is_featured ? 'text-amber-500 hover:bg-amber-50' : 'text-surface-300 hover:text-amber-500 hover:bg-surface-100' }}">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        </button>
                                    </form>

                                    <!-- Active Toggle -->
                                    <form action="{{ route('admin.service-offers.toggle', $offer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="{{ $offer->is_active ? 'تعطيل' : 'تفعيل' }}"
                                                class="p-1 rounded-full transition-all {{ $offer->is_active ? 'text-emerald-600 bg-emerald-50' : 'text-surface-400 bg-surface-100' }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $offer->is_active ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Package Title & Service Link -->
                            <div>
                                <h3 class="text-base font-bold text-surface-900 group-hover:text-brand-600 transition-colors">
                                    <a href="{{ route('admin.service-offers.show', $offer->id) }}">
                                        {{ $offer->title }}
                                    </a>
                                </h3>
                                @if($offer->service)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-600 mt-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        <span>{{ $offer->service->title }}</span>
                                    </span>
                                @else
                                    <span class="text-[11px] text-surface-400 mt-1 block">باقة حلول عامة</span>
                                @endif
                            </div>

                            <!-- Pricing Block -->
                            <div class="p-3.5 rounded-2xl bg-surface-50 border border-surface-200/80 space-y-1">
                                <div class="flex items-baseline gap-2">
                                    @if($offer->discount_price && $offer->discount_price > 0)
                                        <span class="text-2xl font-black text-brand-600 font-outfit">{{ number_format($offer->discount_price) }}</span>
                                        <span class="text-sm font-bold text-surface-400 line-through font-outfit">{{ number_format($offer->price) }}</span>
                                    @else
                                        <span class="text-2xl font-black text-surface-900 font-outfit">{{ number_format($offer->price) }}</span>
                                    @endif
                                    <span class="text-xs font-bold text-surface-500">{{ $offer->currency }}</span>
                                    <span class="text-[10px] text-surface-400 font-medium">/ {{ $offer->billing_period_label }}</span>
                                </div>
                                <span class="text-[10px] text-surface-400 block">+ ضريبة القيمة المضافة 15%</span>
                            </div>

                            <!-- Description -->
                            @if($offer->description)
                                <p class="text-xs text-surface-600 line-clamp-2 leading-relaxed">
                                    {{ $offer->description }}
                                </p>
                            @endif

                            <!-- Features Preview Checklist -->
                            @php $feats = $offer->features; @endphp
                            @if(!empty($feats) && count($feats) > 0)
                                <div class="space-y-1.5 pt-2 border-t border-surface-100 text-xs">
                                    @foreach(array_slice($feats, 0, 3) as $feat)
                                        <div class="flex items-start gap-2 text-surface-700">
                                            <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span class="line-clamp-1">{{ $feat }}</span>
                                        </div>
                                    @endforeach
                                    @if(count($feats) > 3)
                                        <span class="text-[10px] text-surface-400 block pt-0.5 font-medium">+ {{ count($feats) - 3 }} مواصفات وبنود إضافية...</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer & Action Toolbar -->
                        <div class="pt-4 mt-4 border-t border-surface-100 flex items-center justify-between gap-2">
                            <span class="text-[11px] font-mono text-surface-400">#{{ $offer->sort_order }}</span>

                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('admin.service-offers.show', $offer->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                                    <span>عرض التفاصيل</span>
                                </a>

                                <a href="{{ route('admin.service-offers.edit', $offer->id) }}" class="p-1.5 rounded-lg text-surface-500 hover:text-brand-600 hover:bg-brand-50 transition-colors" title="تعديل">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>

                                <form action="{{ route('admin.service-offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذه الباقة نهائياً؟' : 'Delete this package permanently?' }}');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-surface-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="حذف">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-surface-400">
                        <div class="max-w-xs mx-auto space-y-3">
                            <div class="w-12 h-12 rounded-2xl bg-surface-100 flex items-center justify-center text-surface-400 mx-auto">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <span class="block text-sm font-bold text-surface-700">لا توجد باقات عروض مسجلة حالياً</span>
                            <a href="{{ route('admin.service-offers.create') }}" class="btn-primary text-xs py-2 px-4 inline-flex">
                                <span>+ تسجيل أول باقة عرض</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($offers->hasPages())
            <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
                {{ $offers->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
