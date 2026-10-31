@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إدارة تقييمات وشهادات العملاء' : 'Manage Client Testimonials') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'تقييمات وشهادات العملاء' : 'Client Testimonials')

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Testimonials -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الشهادات' : 'Total Reviews' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit">{{ $stats['total'] }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'آراء شركاء النجاح والمؤسسات' : 'Registered client testimonials' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
        </div>

        <!-- Active on Site -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'الشهادات المنشورة' : 'Active on Site' }}
                </span>
                <span class="text-3xl font-black text-emerald-600 font-outfit">{{ $stats['active'] }}</span>
                <span class="text-[11px] text-emerald-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'ظاهرة للجمهور في الموقع' : 'Visible on live portal' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Featured Testimonials -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المميّزة بالرئيسية' : 'Featured in Hero' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit">{{ $stats['featured'] }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'واجهة التقييمات الرئيسية' : 'Featured showcase' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            </div>
        </div>

        <!-- Average Rating -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-sky-100 group hover:border-sky-300 transition-all">
            <div>
                <span class="text-xs text-sky-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'متوسط التقييم' : 'Average Rating' }}
                </span>
                <div class="flex items-center gap-2">
                    <span class="text-3xl font-black text-amber-500 font-outfit">{{ $stats['avg_rating'] }}</span>
                    <span class="text-xs text-surface-400 font-bold">/ 5.0</span>
                </div>
                <div class="flex items-center gap-0.5 text-amber-400 text-xs mt-1">
                    @for($s = 1; $s <= 5; $s++)
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    @endfor
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 border border-sky-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Add Button -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'قائمة شهادات وآراء العملاء' : 'Client Testimonials Directory' }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'إدارة تقييمات العملاء والشركات المنفذة لمشاريع الأنظمة الأمنية والتقنية الذكية' : 'Manage client feedback, reviews, project ratings, and featured testimonials' }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.testimonials.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'إضافة تقييم جديد' : 'Add Testimonial' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.testimonials.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'البحث بالعميل، الشركة، المدينة، أو نوع المشروع...' : 'Search by client, company, city, or project type...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Status Filter -->
                <select name="status" class="py-2 px-3 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 focus:outline-none focus:border-brand-500">
                    <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع الحالات' : 'All Statuses' }}</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المنشورة فقط' : 'Active Only' }}</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المعطلة فقط' : 'Inactive Only' }}</option>
                    <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المميزة فقط' : 'Featured Only' }}</option>
                </select>

                <!-- Rating Filter -->
                <select name="rating" class="py-2 px-3 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 focus:outline-none focus:border-brand-500">
                    <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع التقييمات' : 'All Ratings' }}</option>
                    <option value="5" {{ request('rating') === '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 نجوم)</option>
                    <option value="4" {{ request('rating') === '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 نجوم)</option>
                    <option value="3" {{ request('rating') === '3' ? 'selected' : '' }}>⭐⭐⭐ (3 نجوم)</option>
                </select>

                <button type="submit" class="btn-secondary text-xs py-2 px-4">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request()->anyFilled(['q', 'status', 'rating']))
                    <a href="{{ route('admin.testimonials.index') }}" class="text-xs text-rose-500 hover:underline px-2">
                        {{ app()->getLocale() === 'ar' ? 'إلغاء الفلتر' : 'Reset' }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'العميل والمؤسسة' : 'Client & Company' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'المشروع والمدينة' : 'Project & City' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'التقييم' : 'Rating' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'نص الرأي والشهادة' : 'Review Text' }}</th>
                        <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}</th>
                        <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'ar' ? 'مميز' : 'Featured' }}</th>
                        <th class="py-3.5 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @forelse($testimonials as $item)
                        <tr class="hover:bg-brand-50/20 transition-colors {{ !$item->is_active ? 'opacity-60 bg-surface-50/40' : '' }}">
                            <!-- Client Info with Avatar or Initials -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3.5">
                                    @if($item->avatar_url)
                                        <div class="w-10 h-10 rounded-full overflow-hidden border border-brand-200/60 shadow-xs flex-shrink-0">
                                            <img src="{{ $item->avatar_url }}" alt="{{ $item->client_name }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-600 to-amber-500 text-white font-black flex items-center justify-center text-sm shadow-xs flex-shrink-0">
                                            {{ $item->initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="font-bold text-surface-900 block text-sm">{{ $item->client_name }}</span>
                                        <span class="text-[11px] text-surface-400 block font-normal">
                                            {{ $item->client_position ?: ($item->company ?: 'عميل موثّق') }}
                                        </span>
                                        @if($item->company && $item->client_position)
                                            <span class="text-[10px] text-brand-600 font-medium block">{{ $item->company }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Project & City -->
                            <td class="py-4 px-6">
                                @if($item->project_type)
                                    <span class="inline-block px-2.5 py-1 rounded-lg text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200 mb-1">
                                        {{ $item->project_type }}
                                    </span>
                                @endif
                                @if($item->city)
                                    <div class="flex items-center gap-1 text-[11px] text-surface-400">
                                        <svg class="w-3.5 h-3.5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>{{ $item->city }}</span>
                                    </div>
                                @endif
                            </td>

                            <!-- Rating Stars -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-0.5 text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        @else
                                            <svg class="w-4 h-4 fill-surface-200" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-[10px] text-surface-400 font-mono font-bold mt-0.5 block">{{ $item->rating }} / 5.0</span>
                            </td>

                            <!-- Review Text -->
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-surface-800 line-clamp-2 text-xs leading-relaxed" title="{{ $item->review_text }}">
                                    "{{ $item->review_text }}"
                                </p>
                                @if($item->review_text_en)
                                    <span class="text-[10px] text-surface-400 font-outfit line-clamp-1 mt-1 block" dir="ltr">
                                        "{{ $item->review_text_en }}"
                                    </span>
                                @endif
                            </td>

                            <!-- Active Status Toggle -->
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.testimonials.toggle', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cursor-pointer inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold transition-all {{ $item->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-surface-100 text-surface-500 border border-surface-200 hover:bg-surface-200' }}">
                                        <span class="w-2 h-2 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-surface-400' }}"></span>
                                        <span>{{ $item->is_active ? (app()->getLocale() === 'ar' ? 'منشور' : 'Active') : (app()->getLocale() === 'ar' ? 'معطّل' : 'Inactive') }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Featured Status Toggle -->
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.testimonials.featured', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cursor-pointer inline-flex items-center gap-1 px-2 py-1 rounded-lg text-[10px] font-bold transition-all {{ $item->is_featured ? 'bg-amber-100 text-amber-800 border border-amber-300 shadow-xs' : 'bg-surface-50 text-surface-400 border border-surface-200 hover:text-amber-600' }}">
                                        <span>⭐</span>
                                        <span>{{ $item->is_featured ? (app()->getLocale() === 'ar' ? 'مميّز' : 'Featured') : (app()->getLocale() === 'ar' ? 'عادي' : 'Standard') }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا التقييم؟' : 'Are you sure you want to delete this testimonial?' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-surface-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="{{ __('messages.delete') }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-16 text-surface-400">
                                {{ app()->getLocale() === 'ar' ? 'لا توجد تقييمات عملاء مسجلة حالياً.' : 'No client testimonials found.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
            {{ $testimonials->links() }}
        </div>
    </div>

</div>

@endsection
