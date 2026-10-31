@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل طلب عرض السعر: ' : 'Edit Quote Request: ') . $quote->reference_number . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'تعديل عرض السعر: ' : 'Edit Quote: ') . $quote->reference_number)

@section('content')

<div class="max-w-4xl space-y-6">

    <!-- Back Button -->
    <a href="{{ route('admin.quotes.show', $quote->id) }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>{{ app()->getLocale() === 'ar' ? 'العودة لتفاصيل الطلب' : 'Back to Quote Details' }}</span>
    </a>

    <!-- Main Card -->
    <div class="card-light rounded-3xl p-6 sm:p-8 shadow-soft">
        <div class="border-b border-surface-100 pb-5 mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-surface-900">
                    {{ app()->getLocale() === 'ar' ? 'تعديل بيانات طلب عرض السعر' : 'Edit Quote Request Specifications' }}
                </h2>
                <span class="text-xs font-mono font-bold text-brand-600 block mt-0.5">{{ $quote->reference_number }}</span>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $quote->status_badge_class }}">
                {{ $quote->status_label }}
            </span>
        </div>

        <form action="{{ route('admin.quotes.update', $quote->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Client Information -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '1. بيانات العميل والجهة' : '1. Client Details' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Client Full Name -->
                    <div>
                        <label for="full_name" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم العميل <span class="text-rose-500">*</span></label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $quote->full_name) }}" required
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                        @error('full_name')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم المنشأة أو الشركة</label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $quote->company_name) }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-surface-700 uppercase mb-2">رقم الجوال <span class="text-rose-500">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $quote->phone) }}" required dir="ltr"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono text-start">
                        @error('phone')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-surface-700 uppercase mb-2">البريد الإلكتروني <span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $quote->email) }}" required dir="ltr"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 text-start">
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Project Specifications -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '2. مواصفات ونطاق المشروع' : '2. Project Scope' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Service -->
                    <div>
                        <label for="service_id" class="block text-xs font-bold text-surface-700 uppercase mb-2">الخدمة المطلوبة</label>
                        <select id="service_id" name="service_id" class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'حلول هندسية عامة / متكاملة' : 'General / Integrated Solution' }}</option>
                            @foreach($services as $srv)
                                <option value="{{ $srv->id }}" {{ old('service_id', $quote->service_id) == $srv->id ? 'selected' : '' }}>
                                    {{ $srv->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Project Type -->
                    <div>
                        <label for="project_type" class="block text-xs font-bold text-surface-700 uppercase mb-2">نوع المشروع <span class="text-rose-500">*</span></label>
                        <select id="project_type" name="project_type" required class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                            @foreach($projectTypes as $pKey => $pVal)
                                <option value="{{ $pKey }}" {{ old('project_type', $quote->project_type) === $pKey ? 'selected' : '' }}>
                                    {{ $pVal[app()->getLocale()] ?? $pKey }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-xs font-bold text-surface-700 uppercase mb-2">الموقع / المدينة</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $quote->location) }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                    </div>

                    <!-- Estimated Budget -->
                    <div>
                        <label for="estimated_budget" class="block text-xs font-bold text-surface-700 uppercase mb-2">الميزانية التقديرية</label>
                        <input type="text" id="estimated_budget" name="estimated_budget" value="{{ old('estimated_budget', $quote->estimated_budget) }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-xs font-bold text-surface-700 uppercase mb-2">حالة الطلب <span class="text-rose-500">*</span></label>
                        <select id="status" name="status" required class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-bold">
                            <option value="pending" {{ old('status', $quote->status) === 'pending' ? 'selected' : '' }}>قيد الانتظار (Pending)</option>
                            <option value="under_review" {{ old('status', $quote->status) === 'under_review' ? 'selected' : '' }}>قيد الدراسة الفنية (Under Review)</option>
                            <option value="contacted" {{ old('status', $quote->status) === 'contacted' ? 'selected' : '' }}>تم التواصل (Contacted)</option>
                            <option value="completed" {{ old('status', $quote->status) === 'completed' ? 'selected' : '' }}>مكتمل ومعتمد (Completed)</option>
                            <option value="cancelled" {{ old('status', $quote->status) === 'cancelled' ? 'selected' : '' }}>ملغي (Cancelled)</option>
                        </select>
                    </div>

                    <!-- Attachment -->
                    <div>
                        <label for="attachment" class="block text-xs font-bold text-surface-700 uppercase mb-2">استبدال أو إرفاق ملف</label>
                        <input type="file" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.zip,.png,.jpg,.jpeg"
                               class="w-full px-3 py-2 rounded-xl bg-surface-50 border border-surface-200 text-surface-700 text-xs focus:outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        @if($quote->attachment_path)
                            <div class="mt-2 flex items-center justify-between p-2 rounded-lg bg-surface-100 border border-surface-200 text-xs">
                                <span class="truncate max-w-[200px] text-surface-700 font-mono">{{ basename($quote->attachment_path) }}</span>
                                <label class="flex items-center gap-1.5 text-rose-600 text-[11px] font-bold cursor-pointer">
                                    <input type="checkbox" name="remove_attachment" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                                    <span>حذف الملف</span>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-xs font-bold text-surface-700 uppercase mb-2">تفاصيل الطلب ونطاق الأعمال <span class="text-rose-500">*</span></label>
                    <textarea id="message" name="message" rows="4" required
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 leading-relaxed">{{ old('message', $quote->message) }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 3: Internal Notes -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '3. الملاحظات الهندسية والإدارية' : '3. Administrative Notes' }}
                </h3>

                <div>
                    <label for="admin_notes" class="block text-xs font-bold text-surface-700 uppercase mb-2">سجل المتابعة الداخلي</label>
                    <textarea id="admin_notes" name="admin_notes" rows="4"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 leading-relaxed">{{ old('admin_notes', $quote->admin_notes) }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-surface-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.quotes.show', $quote->id) }}" class="btn-secondary py-3 px-6">
                    {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                </a>
                <button type="submit" class="btn-primary py-3 px-8 shadow-brand-glow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حفظ التعديلات' : 'Save Changes' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
