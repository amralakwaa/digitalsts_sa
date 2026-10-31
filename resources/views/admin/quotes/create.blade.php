@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تسجيل طلب عرض سعر جديد' : 'New Quote Request Entry') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'تسجيل طلب عرض سعر جديد' : 'New Quote Request')

@section('content')

<div class="max-w-4xl space-y-6">

    <!-- Back Button -->
    <a href="{{ route('admin.quotes.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>{{ __('messages.back_to_quotes') }}</span>
    </a>

    <!-- Main Card -->
    <div class="card-light rounded-3xl p-6 sm:p-8 shadow-soft">
        <div class="border-b border-surface-100 pb-5 mb-6">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'تسجيل طلب تسعير أو دراسة فنية جديدة' : 'Register New Quote Request or RFP Study' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                {{ app()->getLocale() === 'ar' ? 'أدخل بيانات العميل والمشروع المستلم عبر الهاتف، البريد المباشر، أو الاجتماعات الميدانية' : 'Log direct client inquiries, RFP documents, or phone inquiries into the central pipeline' }}
            </p>
        </div>

        <form action="{{ route('admin.quotes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Section 1: Reference & Client Info -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '1. بيانات العميل والجهة الطالبة' : '1. Client & Organization Information' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Reference Number -->
                    <div>
                        <label for="reference_number" class="block text-xs font-bold text-surface-700 uppercase mb-2">الرقم المرجعي (تلقائي)</label>
                        <input type="text" id="reference_number" name="reference_number" value="{{ old('reference_number', $suggestedRef) }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-100 border border-surface-200 text-brand-600 font-mono font-bold text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                        @error('reference_number')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Client Full Name -->
                    <div>
                        <label for="full_name" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم العميل / المسؤول <span class="text-rose-500">*</span></label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required
                               placeholder="مثال: م. خالد بن عبدالله الشهري"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10">
                        @error('full_name')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-surface-700 uppercase mb-2">رقم الجوال / الهاتف <span class="text-rose-500">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required dir="ltr"
                               placeholder="+966 50 000 0000"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 font-mono text-start">
                        @error('phone')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-surface-700 uppercase mb-2">البريد الإلكتروني <span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required dir="ltr"
                               placeholder="client@company.com.sa"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-start">
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company / Organization -->
                    <div class="sm:col-span-2">
                        <label for="company_name" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم الشركة أو الجهة (إن وجد)</label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}"
                               placeholder="مثال: شركة التطوير العقاري، مستشفى الرياض التخصصي..."
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10">
                    </div>
                </div>
            </div>

            <!-- Section 2: Project Specifications -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '2. مواصفات ونطاق المشروع' : '2. Project Specifications' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Service -->
                    <div>
                        <label for="service_id" class="block text-xs font-bold text-surface-700 uppercase mb-2">الخدمة / الحل الهندسي المطلوب</label>
                        <select id="service_id" name="service_id" class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'حلول هندسية عامة / متكاملة' : 'General / Integrated Solution' }}</option>
                            @foreach($services as $srv)
                                <option value="{{ $srv->id }}" {{ old('service_id') == $srv->id ? 'selected' : '' }}>
                                    {{ $srv->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Project Type -->
                    <div>
                        <label for="project_type" class="block text-xs font-bold text-surface-700 uppercase mb-2">نوع وطبيعة المنشأة <span class="text-rose-500">*</span></label>
                        <select id="project_type" name="project_type" required class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                            @foreach($projectTypes as $pKey => $pVal)
                                <option value="{{ $pKey }}" {{ old('project_type') === $pKey ? 'selected' : '' }}>
                                    {{ $pVal[app()->getLocale()] ?? $pKey }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-xs font-bold text-surface-700 uppercase mb-2">موقع المشروع / المدينة</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                               placeholder="مثال: الرياض - حي الصحافة، جدة، المنطقة الشرقية..."
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                    </div>

                    <!-- Estimated Budget -->
                    <div>
                        <label for="estimated_budget" class="block text-xs font-bold text-surface-700 uppercase mb-2">الميزانية التقديرية المتوقعة</label>
                        <input type="text" id="estimated_budget" name="estimated_budget" value="{{ old('estimated_budget') }}"
                               placeholder="مثال: 50,000 - 150,000 ريال سعودي"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                    </div>

                    <!-- Initial Status -->
                    <div>
                        <label for="status" class="block text-xs font-bold text-surface-700 uppercase mb-2">الحالة الأولية للطلب <span class="text-rose-500">*</span></label>
                        <select id="status" name="status" required class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-bold">
                            <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>قيد الانتظار (Pending)</option>
                            <option value="under_review" {{ old('status') === 'under_review' ? 'selected' : '' }}>قيد المراجعة الفنية (Under Review)</option>
                            <option value="contacted" {{ old('status') === 'contacted' ? 'selected' : '' }}>تم التواصل الأولي (Contacted)</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>مكتمل ومعتمد (Completed)</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>ملغي (Cancelled)</option>
                        </select>
                    </div>

                    <!-- RFP Attachment -->
                    <div>
                        <label for="attachment" class="block text-xs font-bold text-surface-700 uppercase mb-2">ملف المخططات أو كراسة الشروط (RFP)</label>
                        <input type="file" id="attachment" name="attachment"
                               accept=".pdf,.doc,.docx,.zip,.png,.jpg,.jpeg"
                               class="w-full px-3 py-2 rounded-xl bg-surface-50 border border-surface-200 text-surface-700 text-xs focus:outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        <p class="mt-1 text-[11px] text-surface-400">PDF, Word, ZIP, أو صور (بحد أقصى 10 ميجابايت)</p>
                    </div>
                </div>

                <!-- Message / Scope of Work -->
                <div>
                    <label for="message" class="block text-xs font-bold text-surface-700 uppercase mb-2">تفاصيل الطلب ونطاق الأعمال الفنية <span class="text-rose-500">*</span></label>
                    <textarea id="message" name="message" rows="4" required
                              placeholder="اكتب هنا تفاصيل متطلبات المشروع، عدد الكاميرات، مساحة المنشأة، نوعية المعدات، وأي متطلبات تشغيلية خاصة..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 leading-relaxed">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 3: Internal Admin Notes -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '3. الملاحظات الهندسية والإدارية الداخلية' : '3. Internal Administrative Notes' }}
                </h3>

                <div>
                    <label for="admin_notes" class="block text-xs font-bold text-surface-700 uppercase mb-2">سجل المتابعة والملاحظات (خاص بفريق STS)</label>
                    <textarea id="admin_notes" name="admin_notes" rows="3"
                              placeholder="ملاحظات التواصل الأولي، موعد المعاينة، عرض السعر المبدئي، اسم المهندس المكلف بالدراسة..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 leading-relaxed">{{ old('admin_notes') }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-surface-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.quotes.index') }}" class="btn-secondary py-3 px-6">
                    {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                </a>
                <button type="submit" class="btn-primary py-3 px-8 shadow-brand-glow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حفظ وتسجيل الطلب' : 'Save & Register Quote' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
