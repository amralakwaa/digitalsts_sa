@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل تقييم: ' : 'Edit Testimonial: ') . $testimonial->client_name . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'تعديل تقييم العميل' : 'Edit Testimonial')

@section('content')

<div class="max-w-4xl space-y-6">
    
    <!-- Top Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة التقييمات' : 'Back to Testimonials' }}</span>
        </a>

        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا التقييم؟' : 'Are you sure you want to delete this testimonial?' }}');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 text-xs font-bold transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>{{ __('messages.delete') }}</span>
            </button>
        </form>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Main Card -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="border-b border-surface-100 pb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'تعديل بيانات العميل والمشروع' : 'Edit Client & Review Data' }}</h2>
                    <span class="text-xs text-surface-400">{{ app()->getLocale() === 'ar' ? 'تحديث نص الشهادة، التقييم، وتفاصيل المؤسسة' : 'Modify testimonial review text, rating, and corporate info' }}</span>
                </div>
                <div class="text-[11px] font-mono text-surface-400">
                    ID: #{{ $testimonial->id }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Client Name -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'اسم العميل المعتمد *' : 'Client Full Name *' }}
                    </label>
                    <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all @error('client_name') border-rose-500 @enderror">
                    @error('client_name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'المسمى الوظيفي' : 'Job Title / Position' }}
                    </label>
                    <input type="text" name="client_position" value="{{ old('client_position', $testimonial->client_position) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- Company -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'اسم الشركة أو الجهة' : 'Company / Organization' }}
                    </label>
                    <input type="text" name="company" value="{{ old('company', $testimonial->company) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- City -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'المدينة / المنطقة' : 'City / Region' }}
                    </label>
                    <input type="text" name="city" value="{{ old('city', $testimonial->city) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- Project Type -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نوع المشروع أو المنظومة المنفذة' : 'System / Project Field' }}
                    </label>
                    <input type="text" name="project_type" value="{{ old('project_type', $testimonial->project_type) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>
            </div>

            <!-- Star Rating Selector -->
            <div class="border-t border-surface-100 pt-6">
                <label class="block text-xs font-bold text-surface-700 uppercase mb-3">
                    {{ app()->getLocale() === 'ar' ? 'التقييم العام (من 1 إلى 5 نجوم) *' : 'Rating Score (1 to 5 Stars) *' }}
                </label>
                <div class="flex items-center gap-4">
                    @php $currentRating = (int) old('rating', $testimonial->rating ?? 5); @endphp
                    @for($star = 5; $star >= 1; $star--)
                        <label class="flex items-center gap-1.5 cursor-pointer px-3.5 py-2 rounded-xl border border-surface-200 hover:border-amber-400 hover:bg-amber-50/30 transition-all has-[:checked]:border-amber-400 has-[:checked]:bg-amber-50 has-[:checked]:shadow-xs">
                            <input type="radio" name="rating" value="{{ $star }}" class="sr-only" {{ $currentRating === $star ? 'checked' : '' }}>
                            <div class="flex items-center text-amber-400 text-xs">
                                @for($i = 1; $i <= $star; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @endfor
                            </div>
                            <span class="text-xs font-bold text-surface-800 ms-1">{{ $star }}</span>
                        </label>
                    @endfor
                </div>
            </div>

            <!-- Review Texts -->
            <div class="border-t border-surface-100 pt-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نص التقييم والشهادة (عربي) *' : 'Client Review (Arabic) *' }}
                    </label>
                    <textarea name="review_text" rows="4" required
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all @error('review_text') border-rose-500 @enderror">{{ old('review_text', $testimonial->review_text) }}</textarea>
                    @error('review_text')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نص التقييم (English - اختياري)' : 'Client Review (English - Optional)' }}
                    </label>
                    <textarea name="review_text_en" rows="3" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit">{{ old('review_text_en', $testimonial->review_text_en) }}</textarea>
                </div>
            </div>

            <!-- Avatar Image Section with current photo -->
            <div class="border-t border-surface-100 pt-6">
                <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'صورة العميل أو شعار الشركة' : 'Client Photo or Organization Logo' }}
                </label>
                <div class="flex items-center gap-5">
                    <div id="avatarPreviewContainer" class="w-16 h-16 rounded-2xl bg-surface-100 border border-surface-200 flex items-center justify-center text-surface-400 overflow-hidden flex-shrink-0 shadow-xs">
                        @if($testimonial->avatar_url)
                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->client_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-brand-600 to-amber-500 text-white font-black flex items-center justify-center text-lg">
                                {{ $testimonial->initials }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 space-y-2">
                        <input type="file" name="avatar" id="avatarInput" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="block w-full text-xs text-surface-500 file:me-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                        @if($testimonial->avatar)
                            <label class="flex items-center gap-2 cursor-pointer text-xs text-rose-600 font-medium">
                                <input type="checkbox" name="remove_avatar" value="1" class="rounded border-surface-300 text-rose-600 focus:ring-rose-500">
                                <span>{{ app()->getLocale() === 'ar' ? 'حذف الصورة المرفوعة والاعتماد على الأحرف الأولى' : 'Remove uploaded photo and fallback to initials' }}</span>
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Display Settings & Sort -->
            <div class="border-t border-surface-100 pt-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Sort Order -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'ترتيب الظهور' : 'Sort Order' }}
                    </label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}" required min="1"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono">
                </div>

                <!-- Active Toggle -->
                <div class="flex items-center gap-3 pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $testimonial->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-surface-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-surface-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        <span class="ms-3 text-xs font-bold text-surface-700">{{ app()->getLocale() === 'ar' ? 'تفعيل العرض في الموقع' : 'Active on Live Site' }}</span>
                    </label>
                </div>

                <!-- Featured Toggle -->
                <div class="flex items-center gap-3 pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $testimonial->is_featured ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-surface-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-surface-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        <span class="ms-3 text-xs font-bold text-surface-700">⭐ {{ app()->getLocale() === 'ar' ? 'تمييز بالصفحة الرئيسية' : 'Featured in Showcase' }}</span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="border-t border-surface-100 pt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary text-xs py-2.5 px-5">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="btn-primary text-xs py-2.5 px-6 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'تحديث وحفظ التعديلات' : 'Update Testimonial' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const container = document.getElementById('avatarPreviewContainer');
        if (file && container) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                container.innerHTML = `<img src="${evt.target.result}" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
