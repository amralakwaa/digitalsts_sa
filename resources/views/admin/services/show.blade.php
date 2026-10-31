@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تفاصيل الخدمة: ' : 'Service Details: ') . $service->title . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'تفاصيل الخدمة: ' : 'Service: ') . $service->title)

@section('content')

<div class="max-w-5xl space-y-6">

    <!-- Top Action & Navigation Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-surface-500 hover:text-brand-600 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>العودة لقائمة الخدمات</span>
        </a>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-700 hover:text-brand-600 hover:bg-surface-100 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>معاينة في الموقع</span>
            </a>

            <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-brand-50 border border-brand-200 text-brand-700 hover:bg-brand-100 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>تعديل الخدمة</span>
            </a>

            <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl border transition-all {{ $service->is_active ? 'bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' }}">
                    <span>{{ $service->is_active ? 'تعطيل الخدمة' : 'تفعيل الخدمة' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Quotes Count -->
        <div class="card-light rounded-2xl p-4 text-center border-brand-100">
            <span class="text-2xl font-black text-surface-900 font-outfit block">{{ $stats['total_quotes'] }}</span>
            <span class="text-[11px] text-surface-400 font-medium">طلبات عروض الأسعار</span>
        </div>

        <!-- Pending Quotes -->
        <div class="card-light rounded-2xl p-4 text-center border-amber-100">
            <span class="text-2xl font-black text-amber-600 font-outfit block">{{ $stats['pending_quotes'] }}</span>
            <span class="text-[11px] text-amber-700 font-medium">طلبات بالانتظار</span>
        </div>

        <!-- Offers Count -->
        <div class="card-light rounded-2xl p-4 text-center border-indigo-100">
            <span class="text-2xl font-black text-indigo-600 font-outfit block">{{ $stats['total_offers'] }}</span>
            <span class="text-[11px] text-indigo-700 font-medium">باقات العروض المسجلة</span>
        </div>

        <!-- Active Offers -->
        <div class="card-light rounded-2xl p-4 text-center border-emerald-100">
            <span class="text-2xl font-black text-emerald-600 font-outfit block">{{ $stats['active_offers'] }}</span>
            <span class="text-[11px] text-emerald-700 font-medium">عروض مفعلة للجمهور</span>
        </div>
    </div>

    <!-- Main Service Card -->
    <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
        <div class="flex items-start justify-between gap-4 border-b border-surface-100 pb-5">
            <div class="flex items-center gap-4">
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title_ar }}" class="w-16 h-16 rounded-2xl object-cover border border-surface-200 shadow-sm">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                @endif
                <div>
                    <h2 class="text-xl font-bold text-surface-900">{{ $service->title_ar }}</h2>
                    <span class="text-sm font-outfit text-surface-500 font-medium block" dir="ltr">{{ $service->title_en }}</span>
                    <span class="text-xs font-mono text-surface-400 mt-0.5 block">{{ $service->slug }}</span>
                </div>
            </div>

            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $service->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-surface-100 text-surface-500 border border-surface-200' }}">
                {{ $service->is_active ? 'مفعلة' : 'معطلة' }}
            </span>
        </div>

        <!-- Description -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80">
                <span class="text-surface-400 block mb-1 font-bold">الوصف بالعربية:</span>
                <p class="text-surface-700 leading-relaxed text-sm">{{ $service->description_ar }}</p>
            </div>
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80" dir="ltr">
                <span class="text-surface-400 block mb-1 font-bold">English Description:</span>
                <p class="text-surface-700 leading-relaxed text-sm font-outfit">{{ $service->description_en }}</p>
            </div>
        </div>

        <!-- Features & Benefits -->
        @php
            $feats = $service->features_ar ?: [];
            $bens = $service->benefits_ar ?: [];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4 border-t border-surface-100 text-xs">
            <div>
                <h4 class="font-bold text-brand-600 uppercase tracking-wider mb-2">أبرز المميزات الفنية:</h4>
                <ul class="space-y-1.5 text-surface-700">
                    @forelse($feats as $f)
                        <li class="flex items-start gap-1.5">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span>{{ $f }}</span>
                        </li>
                    @empty
                        <li class="text-surface-400 italic">لا توجد مميزات مسجلة</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-brand-600 uppercase tracking-wider mb-2">الفوائد التشغيلية للعميل:</h4>
                <ul class="space-y-1.5 text-surface-700">
                    @forelse($bens as $b)
                        <li class="flex items-start gap-1.5">
                            <span class="text-brand-500 font-bold">•</span>
                            <span>{{ $b }}</span>
                        </li>
                    @empty
                        <li class="text-surface-400 italic">لا توجد فوائد مسجلة</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Linked Service Offers / Packages -->
    <div class="card-light rounded-3xl p-6 sm:p-8 space-y-5 shadow-soft border-brand-100">
        <div class="flex items-center justify-between border-b border-surface-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-surface-900">عروض وباقات هذه الخدمة</h3>
                <span class="text-xs text-surface-400">الباقات الترويجية الجاهزة المرتبطة بهذه الخدمة</span>
            </div>
            <a href="{{ route('admin.service-offers.create', ['service_id' => $service->id]) }}" class="btn-primary text-xs py-2 px-3.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>إضافة باقة جديدة</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($service->offers as $off)
                <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80 flex items-center justify-between group hover:border-brand-200 transition-all">
                    <div class="space-y-1">
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.service-offers.show', $off->id) }}" class="font-bold text-surface-900 hover:text-brand-600 text-sm block">
                                {{ $off->title }}
                            </a>
                            @if($off->badge_text)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-brand-50 text-brand-700">
                                    {{ $off->badge_text }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-baseline gap-2 text-xs">
                            <span class="font-black text-brand-600 font-outfit text-base">{{ number_format($off->effective_price) }} {{ $off->currency }}</span>
                            @if($off->discount_price && $off->discount_price > 0)
                                <span class="text-surface-400 line-through text-[11px] font-mono">{{ number_format($off->price) }}</span>
                            @endif
                            <span class="text-surface-400 text-[10px]">/ {{ $off->billing_period_label }}</span>
                        </div>
                    </div>

                    <a href="{{ route('admin.service-offers.show', $off->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                        معاينة
                    </a>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-surface-400 text-xs">
                    لم يتم تسجيل باقات عروض ترويجية مخصصة لهذه الخدمة بعد.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Quote Requests for this Service -->
    <div class="card-light rounded-3xl p-6 sm:p-8 space-y-5 shadow-soft">
        <div class="flex items-center justify-between border-b border-surface-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-surface-900">أحدث طلبات عروض الأسعار لهذه الخدمة</h3>
                <span class="text-xs text-surface-400">العملاء الذين طلبوا دراسة أو تسعير لهذه الخدمة مؤخراً</span>
            </div>
            <a href="{{ route('admin.quotes.index', ['service_id' => $service->id]) }}" class="text-xs font-bold text-brand-600 hover:underline">
                عرض جميع الطلبات ({{ $stats['total_quotes'] }}) ←
            </a>
        </div>

        <div class="divide-y divide-surface-100 text-xs">
            @forelse($service->quoteRequests as $q)
                <div class="py-3 flex items-center justify-between gap-3">
                    <div>
                        <a href="{{ route('admin.quotes.show', $q->id) }}" class="font-bold text-surface-900 hover:text-brand-600 block">
                            {{ $q->full_name }} — {{ $q->company_name ?: $q->phone }}
                        </a>
                        <span class="text-[11px] text-surface-400 font-mono">{{ $q->reference_number }} • {{ $q->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $q->status_badge_class }}">
                        {{ $q->status_label }}
                    </span>
                </div>
            @empty
                <div class="py-8 text-center text-surface-400">
                    لا توجد طلبات عروض أسعار مسجلة لهذه الخدمة حتى الآن.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
