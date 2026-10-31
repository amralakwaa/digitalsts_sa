@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تفاصيل باقة العرض: ' : 'Package Details: ') . $offer->title . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'تفاصيل باقة العرض: ' : 'Package: ') . $offer->title)

@section('content')

<div class="max-w-5xl space-y-6">

    <!-- Action Bar & Print -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.service-offers.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-surface-500 hover:text-brand-600 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>العودة لقائمة الباقات والعروض</span>
        </a>

        <div class="flex items-center gap-2 flex-wrap">
            <!-- Print Proposal Button -->
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-700 hover:bg-surface-100 hover:text-brand-600 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>طباعة كعرض فني رسمي</span>
            </button>

            <!-- Edit Button -->
            <a href="{{ route('admin.service-offers.edit', $offer->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-brand-50 border border-brand-200 text-brand-700 hover:bg-brand-100 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>تعديل الباقة</span>
            </a>

            <!-- Toggle Active -->
            <form action="{{ route('admin.service-offers.toggle', $offer->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl border transition-all {{ $offer->is_active ? 'bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' }}">
                    <span>{{ $offer->is_active ? 'تعطيل مؤقتاً' : 'تفعيل للجمهور' }}</span>
                </button>
            </form>

            <!-- Delete -->
            <form action="{{ route('admin.service-offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الباقة؟');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 transition-colors">
                    <span>حذف</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Official Proposal Document Wrapper -->
    <div class="card-light rounded-3xl p-8 sm:p-10 shadow-soft border-brand-100 space-y-8 bg-white" id="printableProposal">
        
        <!-- Document Header / Official Branding -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-surface-200 pb-6">
            <div class="space-y-1">
                <span class="text-xs font-black text-brand-600 uppercase tracking-widest block font-outfit">STS ENGINEERING SOLUTIONS</span>
                <h1 class="text-2xl font-black text-surface-900">{{ $offer->title_ar }}</h1>
                <span class="text-sm text-surface-500 font-medium font-outfit block" dir="ltr">{{ $offer->title_en }}</span>
            </div>

            <div class="text-start sm:text-end space-y-1">
                <div class="flex items-center sm:justify-end gap-2">
                    @if($offer->badge_text)
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                            {{ $offer->badge_text }}
                        </span>
                    @endif
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $offer->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-surface-100 text-surface-500 border border-surface-200' }}">
                        {{ $offer->is_active ? 'باقة سارية ومفعلة' : 'معطلة مؤقتاً' }}
                    </span>
                </div>
                <span class="text-xs text-surface-400 font-mono block">REF: {{ $offer->slug }}</span>
            </div>
        </div>

        <!-- Pricing Card Breakdown (ZATCA VAT 15%) -->
        @php
            $basePrice = $offer->effective_price;
            $vatAmount = $basePrice * 0.15;
            $totalWithVat = $basePrice + $vatAmount;
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 rounded-3xl bg-gradient-to-br from-surface-50 to-brand-50/30 border border-brand-100">
            <!-- Price Block -->
            <div class="space-y-1">
                <span class="text-xs font-bold text-surface-500 uppercase tracking-wider block">قيمة الباقة (قبل الضريبة)</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-brand-600 font-outfit">{{ number_format($basePrice, 2) }}</span>
                    <span class="text-sm font-bold text-surface-600">{{ $offer->currency }}</span>
                </div>
                @if($offer->discount_price && $offer->discount_price > 0)
                    <div class="flex items-center gap-2 pt-1 text-xs">
                        <span class="text-surface-400 line-through font-mono">{{ number_format($offer->price, 2) }} {{ $offer->currency }}</span>
                        <span class="font-bold text-emerald-600 font-mono">(وفرت {{ $offer->discount_percentage }}%)</span>
                    </div>
                @endif
            </div>

            <!-- VAT Block -->
            <div class="space-y-1 border-t md:border-t-0 md:border-s border-surface-200 pt-4 md:pt-0 md:ps-6">
                <span class="text-xs font-bold text-surface-500 uppercase tracking-wider block">ضريبة القيمة المضافة (15% ZATCA)</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-black text-surface-800 font-outfit">{{ number_format($vatAmount, 2) }}</span>
                    <span class="text-sm font-bold text-surface-500">{{ $offer->currency }}</span>
                </div>
                <span class="text-[11px] text-surface-400 block font-medium">نظام الفاتورة الضريبية المعتمدة</span>
            </div>

            <!-- Total With VAT -->
            <div class="space-y-1 border-t md:border-t-0 md:border-s border-surface-200 pt-4 md:pt-0 md:ps-6">
                <span class="text-xs font-bold text-brand-700 uppercase tracking-wider block">الإجمالي الشامل للضريبة</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-brand-800 font-outfit">{{ number_format($totalWithVat, 2) }}</span>
                    <span class="text-sm font-bold text-brand-700">{{ $offer->currency }}</span>
                </div>
                <span class="text-[11px] text-brand-600 font-bold block">/ {{ $offer->billing_period_label }}</span>
            </div>
        </div>

        <!-- Description -->
        @if($offer->description_ar || $offer->description_en)
            <div class="space-y-3">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">نطاق الباقة والحل التقني</h3>
                <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200/80 space-y-3">
                    @if($offer->description_ar)
                        <p class="text-sm text-surface-800 leading-relaxed">{{ $offer->description_ar }}</p>
                    @endif
                    @if($offer->description_en)
                        <p class="text-xs text-surface-600 leading-relaxed font-outfit border-t border-surface-200/60 pt-3" dir="ltr">{{ $offer->description_en }}</p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Included Specifications & Deliverables -->
        @php
            $featsAr = is_array($offer->features_ar) ? $offer->features_ar : [];
            $featsEn = is_array($offer->features_en) ? $offer->features_en : [];
        @endphp
        <div class="space-y-4">
            <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">جدول المواصفات والبنود المشمولة في الباقة</h3>

            <div class="overflow-x-auto border border-surface-200 rounded-2xl">
                <table class="w-full text-start text-xs">
                    <thead class="bg-surface-50 font-bold text-surface-600 border-b border-surface-200">
                        <tr>
                            <th class="py-3 px-4 w-12 text-center">#</th>
                            <th class="py-3 px-4">البند والمواصفة الفنية (Arabic)</th>
                            <th class="py-3 px-4" dir="ltr">Technical Specification (English)</th>
                            <th class="py-3 px-4 w-28 text-center">الحالة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-100">
                        @php $maxCount = max(count($featsAr), count($featsEn)); @endphp
                        @for($i = 0; $i < $maxCount; $i++)
                            <tr class="hover:bg-brand-50/20">
                                <td class="py-3 px-4 text-center font-mono font-bold text-surface-400">{{ $i + 1 }}</td>
                                <td class="py-3 px-4 font-bold text-surface-900">{{ $featsAr[$i] ?? '—' }}</td>
                                <td class="py-3 px-4 font-outfit text-surface-600" dir="ltr">{{ $featsEn[$i] ?? '—' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                        ✓ مشمول
                                    </span>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Technical & Warranty Terms -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-surface-100 text-xs">
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200">
                <span class="text-surface-400 block mb-1 font-medium">الخدمة التابعة</span>
                <span class="font-bold text-surface-900 block">{{ $offer->service ? $offer->service->title : 'باقة عامة شاملة' }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200">
                <span class="text-surface-400 block mb-1 font-medium">صلاحية وسريان العرض</span>
                <span class="font-bold text-surface-900 block font-outfit">{{ $offer->valid_until ? $offer->valid_until->format('Y-m-d') : 'ساري بصفة مستمرة' }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200">
                <span class="text-surface-400 block mb-1 font-medium">الضمان والصيانة الميدانية</span>
                <span class="font-bold text-surface-900 block">ضمان شامل معتمد مع قطع الغيار</span>
            </div>
        </div>

        <!-- Proposal Footer / Sign-off -->
        <div class="pt-8 border-t border-surface-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-surface-500">
            <div>
                <span class="font-bold text-surface-900 block">شركة الحلول التقنية الذكية (STS)</span>
                <span class="text-[11px]">الرياض، المملكة العربية السعودية • هاتف: 920000000 • sales@sts.com.sa</span>
            </div>
            <div class="text-start sm:text-end">
                <span class="font-mono text-[10px] text-surface-400 block">تم إنشاء العرض: {{ $offer->created_at->format('Y-m-d H:i') }}</span>
                <span class="text-emerald-600 font-bold text-xs">معتمد من الإدارة الهندسية ✓</span>
            </div>
        </div>

    </div>

</div>

@endsection
