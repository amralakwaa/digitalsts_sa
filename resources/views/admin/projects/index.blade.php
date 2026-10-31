@extends('layouts.admin')

@section('title', __('messages.manage_projects') . ' — STS')
@section('header_title', __('messages.manage_projects'))

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Total Projects -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي المشاريع المسجلة' : 'Total Portfolio Projects' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit">{{ $stats['total'] }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'سابقة الأعمال والإنجازات' : 'All installation case studies' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>

        <!-- Published Projects -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المشاريع المنشورة' : 'Published Projects' }}
                </span>
                <span class="text-3xl font-black text-emerald-600 font-outfit">{{ $stats['published'] }}</span>
                <span class="text-[11px] text-emerald-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'ظاهرة في معرض إنجازات المنصة' : 'Visible on live website' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Draft Projects -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المسودات غير المنشورة' : 'Draft / Hidden Projects' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit">{{ $stats['draft'] }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'مخفية وقيد الإعداد والتجهيز' : 'Internal drafts' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Add Button -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ __('messages.manage_projects') }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'إدارة سابقة الأعمال والمشاريع المنفذة وقصص النجاح ومعارض الصور' : 'Manage portfolio, case studies, galleries, and enterprise installations' }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'إضافة مشروع جديد' : 'Add New Project' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'البحث عن مشروع بالاسم أو العميل أو الموقع...' : 'Search projects by title, client or location...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Category Filter -->
                <div class="w-44">
                    <select name="category" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ request('category') === 'all' || !request('category') ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'جميع القطاعات' : 'All Sectors' }}
                        </option>
                        <option value="commercial" {{ request('category') === 'commercial' ? 'selected' : '' }}>تجاري ومكاتب</option>
                        <option value="hospitality" {{ request('category') === 'hospitality' ? 'selected' : '' }}>ضيافة وفنادق</option>
                        <option value="residential" {{ request('category') === 'residential' ? 'selected' : '' }}>سكني وقصور</option>
                        <option value="industrial" {{ request('category') === 'industrial' ? 'selected' : '' }}>صناعي ومستودعات</option>
                        <option value="government" {{ request('category') === 'government' ? 'selected' : '' }}>حكومي ومؤسسات</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="w-40">
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'جميع الحالات' : 'All Statuses' }}
                        </option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'المنشورة فقط' : 'Published' }}
                        </option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'المسودات فقط' : 'Drafts' }}
                        </option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-secondary text-xs py-2 px-3.5">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request('q') || (request('category') && request('category') !== 'all') || (request('status') && request('status') !== 'all'))
                    <a href="{{ route('admin.projects.index') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold px-2">
                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط' : 'Reset' }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Projects Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-6 w-16">الترتيب</th>
                        <th class="py-3.5 px-6">المشروع وسابقة الأعمال</th>
                        <th class="py-3.5 px-6">القطاع والعميل</th>
                        <th class="py-3.5 px-6">الصور والتوثيق</th>
                        <th class="py-3.5 px-6">الحالة</th>
                        <th class="py-3.5 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @forelse($projects as $proj)
                        <tr class="hover:bg-brand-50/20 transition-colors">
                            <!-- Sort Order -->
                            <td class="py-4 px-6 font-mono font-bold text-surface-900">
                                <span class="px-2.5 py-1 rounded-lg bg-surface-100 border border-surface-200 text-surface-700">
                                    #{{ $proj->sort_order }}
                                </span>
                            </td>

                            <!-- Title & Cover Thumbnail -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3.5">
                                    @if($proj->cover_image_url)
                                        <img src="{{ $proj->cover_image_url }}" alt="{{ $proj->title_ar }}" class="w-14 h-12 rounded-xl object-cover border border-surface-200 flex-shrink-0 shadow-sm" loading="lazy">
                                    @else
                                        <div class="w-14 h-12 rounded-xl bg-surface-100 text-surface-400 border border-surface-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                    @endif
                                    <div class="space-y-0.5 max-w-sm">
                                        <span class="font-bold text-surface-900 block text-sm">{{ $proj->title_ar }}</span>
                                        <span class="text-xs text-surface-500 font-medium font-outfit block">{{ $proj->title_en }}</span>
                                        <span class="text-[11px] text-surface-400 block line-clamp-1 mt-0.5">{{ $proj->description_ar }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Category & Client -->
                            <td class="py-4 px-6">
                                <div class="space-y-1">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-brand-50 text-brand-700 border border-brand-100">
                                        {{ $proj->category }}
                                    </span>
                                    <div class="text-[11px] text-surface-600 font-medium">
                                        {{ $proj->client ?: 'عميل استراتيجي' }} • {{ $proj->location ?: 'المملكة' }}
                                    </div>
                                </div>
                            </td>

                            <!-- Images Count -->
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-surface-100 text-surface-600 border border-surface-200">
                                    <svg class="w-3.5 h-3.5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $proj->images->count() }} {{ app()->getLocale() === 'ar' ? 'صور إضافية' : 'Photos' }}</span>
                                </span>
                            </td>

                            <!-- Status Toggle -->
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.projects.toggle', $proj->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            title="{{ app()->getLocale() === 'ar' ? 'اضغط لتبديل حالة النشر' : 'Click to toggle published state' }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold transition-all shadow-xs {{ $proj->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-surface-100 text-surface-500 border border-surface-200 hover:bg-surface-200' }}">
                                        <span class="w-2 h-2 rounded-full {{ $proj->is_published ? 'bg-emerald-500 animate-pulse' : 'bg-surface-400' }}"></span>
                                        <span>{{ $proj->is_published ? (app()->getLocale() === 'ar' ? 'منشور' : 'Published') : (app()->getLocale() === 'ar' ? 'مسودة' : 'Draft') }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('projects.show', $proj->slug) }}" target="_blank" title="عرض في الموقع" class="p-1.5 rounded-lg text-surface-400 hover:text-brand-600 hover:bg-brand-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $proj->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المشروع؟ سيتم حذف جميع الصور المرتبطة به.' : 'Are you sure you want to delete this project?' }}');">
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
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-surface-700">
                                        {{ app()->getLocale() === 'ar' ? 'لم يتم العثور على أي مشاريع' : 'No projects found' }}
                                    </p>
                                    <p class="text-xs text-surface-400">
                                        {{ app()->getLocale() === 'ar' ? 'جرّب البحث بكلمة مختلفة أو اختر تصنيفاً آخر' : 'Try searching with different terms or select another category' }}
                                    </p>
                                    <a href="{{ route('admin.projects.index') }}" class="btn-secondary text-xs inline-flex py-1.5 px-3">
                                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط التصفية' : 'Clear Filters' }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
