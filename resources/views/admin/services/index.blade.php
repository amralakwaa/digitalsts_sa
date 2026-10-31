@extends('layouts.admin')

@section('title', __('messages.manage_services') . ' — STS')
@section('header_title', __('messages.manage_services'))

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Total Services -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الخدمات المسجلة' : 'Total Registered Services' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit">{{ $stats['total'] }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'جميع الحلول الهندسية في النظام' : 'All engineering solutions' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <!-- Active Services -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'الخدمات المفعلة للجمهور' : 'Active Public Services' }}
                </span>
                <span class="text-3xl font-black text-emerald-600 font-outfit">{{ $stats['active'] }}</span>
                <span class="text-[11px] text-emerald-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'ظاهرة في الموقع ومتاحة للطلب' : 'Visible and requestable online' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Inactive Services -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'الخدمات المعطلة مؤقتاً' : 'Inactive / Draft Services' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit">{{ $stats['inactive'] }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'مخفية عن الزوار' : 'Hidden from public catalog' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Action Bar -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ __('messages.manage_services') }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'إدارة وتخصيص وتفعيل الخدمات والحلول الهندسية في المنصة وتحديث تفاصيلها' : 'Configure, activate, and manage engineering services catalog' }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'إضافة خدمة جديدة' : 'Add New Service' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.services.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'البحث عن خدمة بالاسم أو الوصف...' : 'Search services by title or description...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Status Filter -->
                <div class="w-44">
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'جميع الحالات' : 'All Statuses' }}
                        </option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'الخدمات المفعلة فقط' : 'Active Only' }}
                        </option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'الخدمات المعطلة فقط' : 'Inactive Only' }}
                        </option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <button type="submit" class="btn-secondary text-xs py-2 px-3.5">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request('q') || (request('status') && request('status') !== 'all'))
                    <a href="{{ route('admin.services.index') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold px-2">
                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط' : 'Reset' }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-6 w-16">الترتيب</th>
                        <th class="py-3.5 px-6">الخدمة والحل التقني</th>
                        <th class="py-3.5 px-6">الأيقونة والمواصفات</th>
                        <th class="py-3.5 px-6">طلبات عروض الأسعار</th>
                        <th class="py-3.5 px-6">حالة الظهور</th>
                        <th class="py-3.5 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @forelse($services as $serv)
                        <tr class="hover:bg-brand-50/20 transition-colors">
                            <!-- Sort Order -->
                            <td class="py-4 px-6 font-mono font-bold text-surface-900">
                                <span class="px-2.5 py-1 rounded-lg bg-surface-100 border border-surface-200 text-surface-700">
                                    #{{ $serv->sort_order }}
                                </span>
                            </td>

                            <!-- Title & Image / Icon -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3.5">
                                    @if($serv->image)
                                        <img src="{{ asset('storage/' . $serv->image) }}" alt="{{ $serv->title_ar }}" class="w-12 h-12 rounded-xl object-cover border border-surface-200 flex-shrink-0 shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                    @endif
                                    <div class="space-y-0.5 max-w-sm">
                                        <span class="font-bold text-surface-900 block text-sm">{{ $serv->title_ar }}</span>
                                        <span class="text-xs text-surface-500 font-medium font-outfit block">{{ $serv->title_en }}</span>
                                        <span class="text-[11px] text-surface-400 block line-clamp-1 mt-0.5">{{ $serv->description_ar }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Icon & Feature Count -->
                            <td class="py-4 px-6 text-surface-600">
                                <div class="space-y-1">
                                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-surface-100 text-surface-700 font-mono text-[11px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                                        <span>{{ $serv->icon ?: 'shield-check' }}</span>
                                    </div>
                                    <div class="text-[11px] text-surface-400">
                                        {{ count($serv->features_ar ?: []) }} {{ app()->getLocale() === 'ar' ? 'مميزات' : 'features' }} • {{ count($serv->benefits_ar ?: []) }} {{ app()->getLocale() === 'ar' ? 'فوائد' : 'benefits' }}
                                    </div>
                                </div>
                            </td>

                            <!-- RFPs Count -->
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.quotes.index', ['service_id' => $serv->id]) }}" 
                                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold {{ $serv->quote_requests_count > 0 ? 'bg-brand-50 text-brand-700 border border-brand-200 hover:bg-brand-100' : 'bg-surface-50 text-surface-400 border border-surface-100' }} transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span>{{ $serv->quote_requests_count }} {{ app()->getLocale() === 'ar' ? 'طلب عرض سعر' : 'Quotes' }}</span>
                                </a>
                            </td>

                            <!-- Toggle Status -->
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.services.toggle', $serv->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            title="{{ app()->getLocale() === 'ar' ? 'اضغط لتبديل حالة التفعيل' : 'Click to toggle active state' }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold transition-all shadow-xs {{ $serv->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-surface-100 text-surface-500 border border-surface-200 hover:bg-surface-200' }}">
                                        <span class="w-2 h-2 rounded-full {{ $serv->is_active ? 'bg-emerald-500 animate-pulse' : 'bg-surface-400' }}"></span>
                                        <span>{{ $serv->is_active ? (app()->getLocale() === 'ar' ? 'مفعلة' : 'Active') : (app()->getLocale() === 'ar' ? 'معطلة' : 'Inactive') }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.show', $serv->id) }}" class="btn-secondary text-xs py-1.5 px-3" title="عرض تفاصيل الخدمة وباقاتها">
                                        {{ app()->getLocale() === 'ar' ? 'تفاصيل' : 'Details' }}
                                    </a>
                                    <a href="{{ route('admin.services.edit', $serv->id) }}" class="p-1.5 rounded-lg text-surface-400 hover:text-brand-600 hover:bg-brand-50 transition-colors" title="{{ __('messages.edit') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $serv->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذه الخدمة؟ سيتم حذف جميع البيانات المرتبطة بها.' : 'Are you sure you want to delete this service?' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-surface-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="حذف">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <div class="max-w-xs mx-auto space-y-3 text-center">
                                    <div class="w-12 h-12 rounded-2xl bg-surface-100 text-surface-400 mx-auto flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-surface-700">
                                        {{ app()->getLocale() === 'ar' ? 'لم يتم العثور على أي خدمات مطابقة' : 'No matching services found' }}
                                    </p>
                                    <p class="text-xs text-surface-400">
                                        {{ app()->getLocale() === 'ar' ? 'جرّب البحث بكلمة مفتاحية أخرى أو إلغاء التصفية' : 'Try searching with different terms or reset filters' }}
                                    </p>
                                    <a href="{{ route('admin.services.index') }}" class="btn-secondary text-xs inline-flex py-1.5 px-3">
                                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط التصفية' : 'Clear Filters' }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

