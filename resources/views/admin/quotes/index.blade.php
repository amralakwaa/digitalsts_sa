@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إدارة عروض الأسعار والطلبات' : 'Manage Quote Requests & Proposals') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إدارة عروض الأسعار والطلبات' : 'Quotes & Engineering Proposals')

@section('content')

<div class="space-y-6">

    <!-- Top Summary Metrics Cards (Executive KPIs) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Total Requests -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-brand-100 group hover:border-brand-300 transition-all">
            <div>
                <span class="text-[11px] text-surface-400 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الطلبات' : 'Total Quotes' }}
                </span>
                <span class="text-2xl font-black text-surface-900 font-outfit">{{ $kpis['total'] }}</span>
                <span class="text-[10px] text-surface-400 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'كافة طلبات التسعير' : 'All incoming RFPs' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>

        <!-- Pending Action (Urgent) -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <div class="flex items-center gap-1.5 mb-0.5">
                    <span class="text-[11px] text-amber-800 font-bold uppercase tracking-wider">
                        {{ app()->getLocale() === 'ar' ? 'جديدة بالانتظار' : 'Pending Review' }}
                    </span>
                    @if($kpis['pending'] > 0)
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    @endif
                </div>
                <span class="text-2xl font-black text-amber-600 font-outfit">{{ $kpis['pending'] }}</span>
                <span class="text-[10px] text-amber-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تتطلب دراسة وتواصلاً' : 'Awaiting technical response' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- In Progress (Under Review + Contacted) -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-sky-100 group hover:border-sky-300 transition-all">
            <div>
                <span class="text-[11px] text-sky-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'قيد المتابعة والتحليل' : 'Under Review / Follow-up' }}
                </span>
                <span class="text-2xl font-black text-sky-600 font-outfit">{{ $kpis['in_progress'] }}</span>
                <span class="text-[10px] text-sky-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تواصل جاري مع العميل' : 'Active client negotiations' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 border border-sky-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
        </div>

        <!-- Completed / Won -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-[11px] text-emerald-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'عروض معتمدة ومكتملة' : 'Completed / Won' }}
                </span>
                <span class="text-2xl font-black text-emerald-600 font-outfit">{{ $kpis['completed'] }}</span>
                <span class="text-[10px] text-emerald-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تم التعاقد أو إغلاق الطلب' : 'Finalized & contracted' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="card-light rounded-2xl p-4 flex items-center justify-between border-indigo-100 group hover:border-indigo-300 transition-all">
            <div>
                <span class="text-[11px] text-indigo-800 block mb-0.5 font-bold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'معدل النجاح والإغلاق' : 'Closing Rate' }}
                </span>
                <span class="text-2xl font-black text-indigo-600 font-outfit">{{ $kpis['conversion_rate'] }}%</span>
                <span class="text-[10px] text-indigo-700 block mt-0.5 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'نسبة إتمام الصفقات' : 'Lead-to-deal conversion' }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Action Buttons -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">
                    {{ app()->getLocale() === 'ar' ? 'سجل طلبات عروض الأسعار والدراسات الفنية' : 'Quote Inquiries & Engineering Proposals Directory' }}
                </h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'متابعة العروض، التواصل الفوري مع العملاء، إدارة الحالات، وتوليد التقارير' : 'Track RFP pipelines, instant customer outreach via WhatsApp, status updates, and reports' }}
                </span>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                {{-- Bulk Action Dropdown (Hidden until checkboxes are selected) --}}
                <div id="bulkActionsGroup" style="display:none;" class="flex items-center gap-2">
                    <form id="bulkStatusForm" action="{{ route('admin.quotes.bulkStatus') }}" method="POST" class="inline-flex items-center gap-1.5">
                        @csrf
                        <div id="bulkStatusInputs"></div>
                        <select name="status" onchange="submitBulkStatus(this.value)" class="text-xs py-2 px-3 rounded-xl bg-surface-50 border border-surface-300 font-bold text-surface-800 focus:outline-none">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'تغيير الحالة المحددة إلى...' : 'Change Status to...' }}</option>
                            <option value="pending">قيد الانتظار (Pending)</option>
                            <option value="under_review">قيد المراجعة الفنية (Under Review)</option>
                            <option value="contacted">تم التواصل (Contacted)</option>
                            <option value="completed">مكتمل ومغلق (Completed)</option>
                            <option value="cancelled">ملغي (Cancelled)</option>
                        </select>
                    </form>

                    <button type="button" onclick="submitBulkDelete()" class="btn-primary text-xs py-2 px-3.5 bg-rose-600 hover:bg-rose-700 border-rose-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        <span id="bulkDeleteLabel">{{ app()->getLocale() === 'ar' ? 'حذف المحدد' : 'Delete' }}</span>
                    </button>
                </div>

                {{-- Export CSV / Excel Button --}}
                <a href="{{ route('admin.quotes.export', request()->query()) }}" class="inline-flex items-center gap-1.5 text-xs font-bold py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 transition-all shadow-sm" title="تصدير النتائج إلى ملف Excel">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'تصدير Excel' : 'Export CSV' }}</span>
                </a>

                {{-- Add New Manual Offer Button --}}
                <a href="{{ route('admin.quotes.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'تسجيل طلب عرض جديد' : 'New Quote Request' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Multi-Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100 space-y-3">
            
            <!-- Status Fast Filter Pills -->
            <div class="flex flex-wrap items-center gap-2">
                @php
                    $statusTabs = [
                        'all'          => ['label' => app()->getLocale() === 'ar' ? 'كافة العروض' : 'All Quotes', 'count' => $statusCounts['all'], 'color' => 'brand'],
                        'pending'      => ['label' => app()->getLocale() === 'ar' ? 'قيد الانتظار' : 'Pending', 'count' => $statusCounts['pending'], 'color' => 'amber'],
                        'under_review' => ['label' => app()->getLocale() === 'ar' ? 'قيد الدراسة' : 'Under Review', 'count' => $statusCounts['under_review'], 'color' => 'sky'],
                        'contacted'    => ['label' => app()->getLocale() === 'ar' ? 'تم التواصل' : 'Contacted', 'count' => $statusCounts['contacted'], 'color' => 'indigo'],
                        'completed'    => ['label' => app()->getLocale() === 'ar' ? 'مكتملة ومغلقة' : 'Completed', 'count' => $statusCounts['completed'], 'color' => 'emerald'],
                        'cancelled'    => ['label' => app()->getLocale() === 'ar' ? 'ملغية' : 'Cancelled', 'count' => $statusCounts['cancelled'], 'color' => 'rose'],
                    ];
                    $currentStatus = request('status', 'all');
                @endphp

                @foreach($statusTabs as $key => $tab)
                    <a href="{{ route('admin.quotes.index', array_merge(request()->query(), ['status' => $key, 'page' => 1])) }}"
                       class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 {{ $currentStatus === $key ? 'bg-brand-600 text-white shadow-brand-glow' : 'bg-white border border-surface-200 text-surface-600 hover:text-brand-600 hover:border-brand-200' }}">
                        <span>{{ $tab['label'] }}</span>
                        <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === $key ? 'bg-white/20 text-white' : 'bg-surface-100 text-surface-500' }} font-outfit">{{ $tab['count'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Detailed Search Form -->
            <form action="{{ route('admin.quotes.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 pt-2">
                <input type="hidden" name="status" value="{{ request('status', 'all') }}">

                <!-- Search Input -->
                <div class="relative lg:col-span-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'بحث بالرقم المرجعي، العميل، الهاتف، الشركة، الموقع...' : 'Search ref #, client, phone, company, location...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- Service Filter -->
                <div>
                    <select name="service_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 focus:outline-none focus:border-brand-500">
                        <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع الخدمات والحلول' : 'All Services' }}</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ request('service_id') == $srv->id ? 'selected' : '' }}>
                                {{ $srv->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Project Type Filter -->
                <div>
                    <select name="project_type" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 focus:outline-none focus:border-brand-500">
                        <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع أنواع المشاريع' : 'All Project Types' }}</option>
                        @foreach($projectTypes as $pKey => $pVal)
                            <option value="{{ $pKey }}" {{ request('project_type') === $pKey ? 'selected' : '' }}>
                                {{ $pVal[app()->getLocale()] ?? $pKey }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-primary flex-1 justify-center text-xs py-2 px-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}</span>
                    </button>
                    @if(request()->hasAny(['q', 'service_id', 'project_type', 'date_from', 'date_to']) || (request('status') && request('status') !== 'all'))
                        <a href="{{ route('admin.quotes.index') }}" class="btn-secondary text-xs py-2 px-3 text-rose-600 hover:text-rose-700 border-rose-200 hover:bg-rose-50" title="إعادة تعيين الفلاتر">
                            ✕
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Hidden Bulk Delete Form -->
        <form id="bulkDeleteForm" action="{{ route('admin.quotes.bulkDelete') }}" method="POST" style="display:none;">
            @csrf
            <div id="bulkDeleteInputs"></div>
        </form>

        <!-- Quotes Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-4 w-10 text-center">
                            <input type="checkbox" id="selectAllMaster" onchange="toggleSelectAll(this)" class="rounded border-surface-300 text-brand-600 focus:ring-brand-500 cursor-pointer">
                        </th>
                        <th class="py-3.5 px-4">{{ __('messages.quote_ref') }}</th>
                        <th class="py-3.5 px-4">{{ __('messages.client_name') }} والجهة</th>
                        <th class="py-3.5 px-4">{{ __('messages.service') }} ونوع المشروع</th>
                        <th class="py-3.5 px-4">الموقع والميزانية</th>
                        <th class="py-3.5 px-4">{{ __('messages.status') }}</th>
                        <th class="py-3.5 px-4">{{ __('messages.date') }}</th>
                        <th class="py-3.5 px-4 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @forelse($quotes as $quote)
                        <tr class="hover:bg-brand-50/20 transition-colors group">
                            <!-- Checkbox -->
                            <td class="py-3.5 px-4 text-center">
                                <input type="checkbox" value="{{ $quote->id }}" onchange="updateBulkUI()" class="quote-checkbox rounded border-surface-300 text-brand-600 focus:ring-brand-500 cursor-pointer">
                            </td>

                            <!-- Reference Number -->
                            <td class="py-3.5 px-4 font-mono font-bold">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.quotes.show', $quote->id) }}" class="text-brand-600 hover:text-brand-800 hover:underline block font-mono">
                                        {{ $quote->reference_number }}
                                    </a>
                                    @if($quote->attachment_path)
                                        <a href="{{ route('admin.quotes.download', $quote->id) }}" title="{{ app()->getLocale() === 'ar' ? 'تحميل المرفق' : 'Download Attachment' }}" class="text-surface-400 hover:text-brand-600">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </td>

                            <!-- Client & Company Details -->
                            <td class="py-3.5 px-4">
                                <div class="space-y-0.5">
                                    <span class="font-bold text-surface-900 block text-xs group-hover:text-brand-700 transition-colors">
                                        {{ $quote->full_name }}
                                    </span>
                                    @if($quote->company_name)
                                        <span class="text-[11px] text-surface-500 block">
                                            {{ $quote->company_name }}
                                        </span>
                                    @endif
                                    <!-- Quick Communication Bar -->
                                    <div class="flex items-center gap-2 pt-1">
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $quote->phone);
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-2 py-0.5 rounded-md border border-emerald-200 transition-colors"
                                           title="محادثة واتساب مباشرة">
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                                            <span>واتساب</span>
                                        </a>

                                        <a href="tel:{{ $quote->phone }}" class="text-[10px] font-mono text-surface-500 hover:text-brand-600" dir="ltr">
                                            {{ $quote->phone }}
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- Service & Project Type -->
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-surface-800 block text-xs">
                                    {{ $quote->service ? $quote->service->title : (app()->getLocale() === 'ar' ? 'حلول هندسية عامة' : 'General Engineering') }}
                                </span>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-surface-100 text-surface-600 border border-surface-200">
                                    {{ $projectTypes[$quote->project_type][app()->getLocale()] ?? $quote->project_type }}
                                </span>
                            </td>

                            <!-- Location & Estimated Budget -->
                            <td class="py-3.5 px-4">
                                <div class="space-y-1">
                                    <span class="text-surface-700 block text-xs flex items-center gap-1">
                                        <svg class="w-3 h-3 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        {{ $quote->location ?: (app()->getLocale() === 'ar' ? 'الرياض / غير محدد' : 'Not specified') }}
                                    </span>
                                    <span class="text-[11px] font-bold text-brand-600 font-mono block">
                                        {{ $quote->estimated_budget ?: '—' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Status Dropdown (Instant AJAX Update) -->
                            <td class="py-3.5 px-4">
                                <div class="relative inline-block">
                                    <select onchange="updateQuoteStatusAjax({{ $quote->id }}, this.value, this)"
                                            class="text-[11px] font-bold rounded-full px-3 py-1 border transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-500/20 {{ $quote->status_badge_class }}">
                                        <option value="pending" {{ $quote->status === 'pending' ? 'selected' : '' }}>قيد الانتظار (Pending)</option>
                                        <option value="under_review" {{ $quote->status === 'under_review' ? 'selected' : '' }}>قيد الدراسة (Under Review)</option>
                                        <option value="contacted" {{ $quote->status === 'contacted' ? 'selected' : '' }}>تم التواصل (Contacted)</option>
                                        <option value="completed" {{ $quote->status === 'completed' ? 'selected' : '' }}>مكتمل ومغلق (Completed)</option>
                                        <option value="cancelled" {{ $quote->status === 'cancelled' ? 'selected' : '' }}>ملغي (Cancelled)</option>
                                    </select>
                                </div>
                            </td>

                            <!-- Date & Time -->
                            <td class="py-3.5 px-4 text-surface-400 text-[11px] font-medium whitespace-nowrap">
                                <span class="block font-outfit text-surface-700 font-semibold">{{ $quote->created_at->format('Y-m-d') }}</span>
                                <span class="block text-[10px] text-surface-400">{{ $quote->created_at->diffForHumans() }}</span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-end whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Show Details -->
                                    <a href="{{ route('admin.quotes.show', $quote->id) }}"
                                       class="p-1.5 rounded-lg text-surface-500 hover:text-brand-600 hover:bg-brand-50 border border-transparent hover:border-brand-200 transition-all"
                                       title="{{ __('messages.view_details') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    <!-- Edit Quote -->
                                    <a href="{{ route('admin.quotes.edit', $quote->id) }}"
                                       class="p-1.5 rounded-lg text-surface-500 hover:text-indigo-600 hover:bg-indigo-50 border border-transparent hover:border-indigo-200 transition-all"
                                       title="تعديل بيانات العرض">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- Delete Quote -->
                                    <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا العرض نهائياً؟' : 'Permanently delete this quote?' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-surface-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition-all" title="{{ app()->getLocale() === 'ar' ? 'حذف' : 'Delete' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-16 text-surface-400">
                                <div class="max-w-xs mx-auto text-center space-y-3">
                                    <div class="w-12 h-12 mx-auto rounded-2xl bg-surface-100 flex items-center justify-center text-surface-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <span class="block text-sm font-bold text-surface-700">{{ __('messages.no_quotes_found') }}</span>
                                    <p class="text-xs text-surface-400">{{ app()->getLocale() === 'ar' ? 'لم يتم العثور على أي طلبات تطابق معايير البحث أو التصفية الحالية.' : 'No quotes match current search parameters.' }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($quotes->hasPages())
            <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
                {{ $quotes->links() }}
            </div>
        @endif

    </div>

</div>

<!-- JavaScript for Bulk Actions and Instant AJAX Status Updates -->
<script>
// Toggle select all checkboxes
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.quote-checkbox');
    checkboxes.forEach(cb => cb.checked = masterCheckbox.checked);
    updateBulkUI();
}

// Update bulk actions visibility and count
function updateBulkUI() {
    const checked = document.querySelectorAll('.quote-checkbox:checked');
    const bulkGroup = document.getElementById('bulkActionsGroup');
    const deleteLabel = document.getElementById('bulkDeleteLabel');
    const count = checked.length;

    if (count > 0) {
        bulkGroup.style.display = 'inline-flex';
        deleteLabel.textContent = '{{ app()->getLocale() === "ar" ? "حذف" : "Delete" }} (' + count + ')';
    } else {
        bulkGroup.style.display = 'none';
    }
}

// Submit Bulk Delete
function submitBulkDelete() {
    const checked = document.querySelectorAll('.quote-checkbox:checked');
    const count = checked.length;
    if (count === 0) return;

    const confirmMsg = '{{ app()->getLocale() === "ar" ? "هل أنت متأكد من حذف الطلبات المحددة نهائياً؟ عدد الطلبات: " : "Permanently delete selected quote requests? Count: " }}' + count;
    if (!confirm(confirmMsg)) return;

    const container = document.getElementById('bulkDeleteInputs');
    container.innerHTML = '';
    checked.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = cb.value;
        container.appendChild(input);
    });

    document.getElementById('bulkDeleteForm').submit();
}

// Submit Bulk Status
function submitBulkStatus(statusVal) {
    if (!statusVal) return;
    const checked = document.querySelectorAll('.quote-checkbox:checked');
    const count = checked.length;
    if (count === 0) return;

    const container = document.getElementById('bulkStatusInputs');
    container.innerHTML = '';
    checked.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = cb.value;
        container.appendChild(input);
    });

    document.getElementById('bulkStatusForm').submit();
}

// AJAX Instant Status Change from dropdown
function updateQuoteStatusAjax(quoteId, newStatus, selectElement) {
    const originalClass = selectElement.className;
    selectElement.disabled = true;

    fetch('{{ url("admin/quotes") }}/' + quoteId + '/quick-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(res => res.json())
    .then(data => {
        selectElement.disabled = false;
        if (data.success) {
            selectElement.className = 'text-[11px] font-bold rounded-full px-3 py-1 border transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-500/20 ' + data.badge_class;
        } else {
            selectElement.className = originalClass;
            alert(data.message || 'Error updating status');
        }
    })
    .catch(err => {
        console.error(err);
        selectElement.disabled = false;
        selectElement.className = originalClass;
    });
}
</script>

@endsection
