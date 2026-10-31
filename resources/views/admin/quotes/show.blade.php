@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تفاصيل طلب عرض السعر: ' : 'Quote Details: ') . $quote->reference_number . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'طلب عرض سعر: ' : 'Quote Request: ') . $quote->reference_number)

@section('content')

<div class="space-y-6 max-w-5xl">
    
    <!-- Top Action & Navigation Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.quotes.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-surface-500 hover:text-brand-600 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ __('messages.back_to_quotes') }}</span>
        </a>

        <div class="flex items-center gap-2 flex-wrap">
            <!-- Print Quote Button -->
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-700 hover:bg-surface-100 hover:text-brand-600 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'طباعة الطلب' : 'Print RFP' }}</span>
            </button>

            <!-- Edit Button -->
            <a href="{{ route('admin.quotes.edit', $quote->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-brand-50 border border-brand-200 text-brand-700 hover:bg-brand-100 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'تعديل البيانات' : 'Edit' }}</span>
            </a>

            <!-- Delete Request Form -->
            <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا الطلب نهائياً؟' : 'Are you sure you want to delete this quote request?' }}');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold py-2 px-3.5 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حذف الطلب' : 'Delete' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Cols: Details -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Client & Reference Header Card -->
            <div class="card-light rounded-3xl p-6 sm:p-8 space-y-5 shadow-soft border-brand-100">
                <div class="flex items-center justify-between border-b border-surface-100 pb-4">
                    <div>
                        <span class="text-[11px] text-surface-400 block mb-0.5 uppercase tracking-wider font-bold">{{ __('messages.quote_ref') }}</span>
                        <span class="text-2xl font-black text-brand-600 font-mono select-all">{{ $quote->reference_number }}</span>
                    </div>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ $quote->status_badge_class }}">
                        {{ $quote->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_full_name') }}</span>
                        <span class="text-sm font-bold text-surface-900">{{ $quote->full_name }}</span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_company') }}</span>
                        <span class="text-sm font-semibold text-surface-800">{{ $quote->company_name ?: '—' }}</span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_email') }}</span>
                        <a href="mailto:{{ $quote->email }}" class="text-sm font-semibold text-brand-600 hover:underline flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span dir="ltr">{{ $quote->email }}</span>
                        </a>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_phone') }}</span>
                        <div class="flex items-center gap-2">
                            <a href="tel:{{ $quote->phone }}" class="text-sm font-bold text-surface-900 hover:text-brand-600" dir="ltr">{{ $quote->phone }}</a>
                            @php $cleanPhone = preg_replace('/[^0-9]/', '', $quote->phone); @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener" class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold hover:bg-emerald-100 border border-emerald-200 transition-colors inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                                <span>واتساب مباشر</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'تاريخ الاستلام والتوثيق' : 'Received At' }}</span>
                        <span class="text-surface-700 font-medium font-outfit">{{ $quote->created_at->format('Y-m-d H:i:s') }} ({{ $quote->created_at->diffForHumans() }})</span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'عنوان IP ولغة الطلب' : 'IP & Preferred Lang' }}</span>
                        <span class="text-surface-600 font-mono">{{ $quote->ip_address ?: '—' }} ({{ strtoupper($quote->preferred_language) }})</span>
                    </div>
                </div>
            </div>

            <!-- Project Specifications Card -->
            <div class="card-light rounded-3xl p-6 sm:p-8 space-y-5 shadow-soft">
                <h3 class="text-base font-bold text-surface-900 border-b border-surface-100 pb-3 flex items-center justify-between">
                    <span>{{ app()->getLocale() === 'ar' ? 'نطاق ومتطلبات المشروع الفنية' : 'Project Scope & Requirements' }}</span>
                    <span class="text-xs text-brand-600 font-normal">معايير STS الهندسية</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_service') }}</span>
                        <span class="text-sm font-bold text-surface-900 block">
                            {{ $quote->service ? $quote->service->title : (app()->getLocale() === 'ar' ? 'طلب عام / دراسة هندسية متكاملة' : 'General Engineering Study') }}
                        </span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_project_type') }}</span>
                        <span class="text-sm font-semibold text-surface-800 block">
                            {{ $projectTypes[$quote->project_type][app()->getLocale()] ?? $quote->project_type }}
                        </span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_location') }}</span>
                        <span class="text-sm text-surface-800 block">{{ $quote->location ?: '—' }}</span>
                    </div>

                    <div>
                        <span class="text-surface-400 block mb-1 font-medium">{{ __('messages.form_budget') }}</span>
                        <span class="text-sm text-brand-600 font-bold font-mono block">{{ $quote->estimated_budget ?: (app()->getLocale() === 'ar' ? 'غير محددة' : 'Not specified') }}</span>
                    </div>
                </div>

                <!-- Customer Message Content -->
                <div class="pt-4 border-t border-surface-100">
                    <span class="text-xs text-surface-500 block mb-2 font-bold">{{ __('messages.form_message') }}</span>
                    <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200 text-sm text-surface-800 whitespace-pre-line leading-relaxed font-sans">
                        {{ $quote->message }}
                    </div>
                </div>

                <!-- Attachment file if exists -->
                @if($quote->attachment_path)
                    <div class="pt-4 border-t border-surface-100 flex items-center justify-between p-4 rounded-2xl bg-brand-50/50 border border-brand-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            </div>
                            <div>
                                <span class="text-xs text-surface-900 font-bold block">{{ app()->getLocale() === 'ar' ? 'المخططات وكراسة الشروط المرفقة (RFP)' : 'Attached RFP Document' }}</span>
                                <span class="text-[11px] text-surface-500 font-mono block">{{ basename($quote->attachment_path) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.quotes.download', $quote->id) }}" class="btn-primary text-xs py-2 px-4 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'تحميل المرفق' : 'Download File' }}</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Col: Administrative Status & Notes -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Update Status & Notes Card -->
            <div class="card-light rounded-3xl p-6 sm:p-7 shadow-soft space-y-5 border-brand-100">
                <h3 class="text-base font-bold text-surface-900 border-b border-surface-100 pb-3">
                    {{ app()->getLocale() === 'ar' ? 'تحديث المعالجة الإدارية' : 'Update Proposal Status' }}
                </h3>

                <form action="{{ route('admin.quotes.update_status', $quote->id) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="status" class="block text-xs font-bold text-surface-700 uppercase mb-2">حالة الطلب الحالية</label>
                        <select id="status" name="status" class="w-full px-3.5 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-xs focus:outline-none focus:bg-white focus:border-brand-500 font-bold">
                            <option value="pending" {{ $quote->status === 'pending' ? 'selected' : '' }}>قيد الانتظار (Pending)</option>
                            <option value="under_review" {{ $quote->status === 'under_review' ? 'selected' : '' }}>قيد المراجعة الفنية (Under Review)</option>
                            <option value="contacted" {{ $quote->status === 'contacted' ? 'selected' : '' }}>تم التواصل مع العميل (Contacted)</option>
                            <option value="completed" {{ $quote->status === 'completed' ? 'selected' : '' }}>مكتمل ومعتمد (Completed)</option>
                            <option value="cancelled" {{ $quote->status === 'cancelled' ? 'selected' : '' }}>ملغي (Cancelled)</option>
                        </select>
                    </div>

                    <div>
                        <label for="admin_notes" class="block text-xs font-bold text-surface-700 uppercase mb-2">ملاحظات هندسية داخلية</label>
                        <textarea id="admin_notes" name="admin_notes" rows="6" 
                                  placeholder="سجل ملاحظات التواصل مع العميل، عروض الأسعار المرسلة، تواريخ المعاينة الميدانية..."
                                  class="w-full px-3.5 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 placeholder-surface-400 text-xs focus:outline-none focus:bg-white focus:border-brand-500 leading-relaxed">{{ old('admin_notes', $quote->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-2.5 shadow-brand-glow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ __('messages.save_changes') }}</span>
                    </button>
                </form>
            </div>

            <!-- Workflow Stage Timeline -->
            <div class="card-light rounded-3xl p-6 shadow-soft space-y-4">
                <h4 class="text-xs font-bold text-surface-900 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'مسار معالجة العرض' : 'Proposal Workflow' }}
                </h4>

                <div class="space-y-4 text-xs">
                    <!-- Step 1 -->
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold shrink-0">✓</div>
                        <div>
                            <span class="font-bold text-surface-900 block">استلام وتوثيق الطلب</span>
                            <span class="text-[10px] text-surface-400">{{ $quote->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    @php $isStep2 = in_array($quote->status, ['under_review', 'contacted', 'completed']); @endphp
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full {{ $isStep2 ? 'bg-emerald-500 text-white' : 'bg-surface-200 text-surface-500' }} flex items-center justify-center text-[10px] font-bold shrink-0">
                            {{ $isStep2 ? '✓' : '2' }}
                        </div>
                        <div>
                            <span class="font-bold {{ $isStep2 ? 'text-surface-900' : 'text-surface-400' }} block">الدراسة الهندسية وتحديد الأسعار</span>
                            <span class="text-[10px] text-surface-400">{{ $isStep2 ? 'قيد المعالجة أو اكتملت' : 'بالانتظار' }}</span>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    @php $isStep3 = in_array($quote->status, ['contacted', 'completed']); @endphp
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full {{ $isStep3 ? 'bg-emerald-500 text-white' : 'bg-surface-200 text-surface-500' }} flex items-center justify-center text-[10px] font-bold shrink-0">
                            {{ $isStep3 ? '✓' : '3' }}
                        </div>
                        <div>
                            <span class="font-bold {{ $isStep3 ? 'text-surface-900' : 'text-surface-400' }} block">التواصل وتقديم العرض الرسمي</span>
                            <span class="text-[10px] text-surface-400">{{ $isStep3 ? 'تم الاتصال بالعميل' : 'بالانتظار' }}</span>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    @php $isStep4 = $quote->status === 'completed'; @endphp
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full {{ $isStep4 ? 'bg-emerald-500 text-white' : 'bg-surface-200 text-surface-500' }} flex items-center justify-center text-[10px] font-bold shrink-0">
                            {{ $isStep4 ? '✓' : '4' }}
                        </div>
                        <div>
                            <span class="font-bold {{ $isStep4 ? 'text-emerald-600' : 'text-surface-400' }} block">الاعتماد النهائي وبدء التنفيذ</span>
                            <span class="text-[10px] text-surface-400">{{ $isStep4 ? 'تم إغلاق الصفقة بنجاح' : 'بالانتظار' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
