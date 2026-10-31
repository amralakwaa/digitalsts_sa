@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'عرض الرسالة: ' : 'View Message: ') . $message->subject . ' — STS Executive')
@section('header_title', app()->getLocale() === 'ar' ? 'تفاصيل رسالة العميل' : 'Customer Inquiry')

@section('content')

<div class="max-w-4xl space-y-6">
    
    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لصندوق الرسائل' : 'Back to Messages Inbox' }}</span>
        </a>

        <div class="flex items-center gap-2">
            <!-- Toggle Read Status -->
            <form action="{{ route('admin.messages.toggleRead', $message->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary text-xs py-1.5 px-3">
                    <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ $message->is_read ? (app()->getLocale() === 'ar' ? 'تحديد كغير مقروءة' : 'Mark as Unread') : (app()->getLocale() === 'ar' ? 'تحديد كمقروءة' : 'Mark as Read') }}</span>
                </button>
            </form>

            <!-- Delete Message -->
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذه الرسالة نهائياً؟' : 'Are you sure you want to permanently delete this message?' }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 text-xs font-bold transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>{{ __('messages.delete') }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Message Card -->
    <div class="card-light rounded-3xl p-6 sm:p-10 space-y-8 shadow-soft">
        
        <!-- Header Info & Client Profile -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-surface-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-600 to-sky-500 text-white font-black text-xl flex items-center justify-center shadow-brand-glow flex-shrink-0">
                    {{ mb_substr($message->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-black text-surface-900 tracking-tight">{{ $message->name }}</h2>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-surface-500 mt-1">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            <a href="mailto:{{ $message->email }}" class="text-brand-600 font-bold hover:underline">{{ $message->email }}</a>
                        </span>
                        @if($message->phone)
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:{{ $message->phone }}" class="text-surface-800 font-bold font-mono hover:text-brand-600" dir="ltr">{{ $message->phone }}</a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Date and Status Pill -->
            <div class="flex flex-col md:items-end gap-1.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تم استلام الرسالة' : 'Received' }}</span>
                </span>
                <span class="text-xs text-surface-400 font-mono">
                    {{ $message->created_at->format('Y-m-d — H:i') }} ({{ $message->created_at->diffForHumans() }})
                </span>
            </div>
        </div>

        <!-- Subject -->
        <div class="space-y-2">
            <span class="text-xs font-bold text-surface-400 uppercase tracking-wider block">
                {{ app()->getLocale() === 'ar' ? 'موضوع الاستفسار' : 'Subject' }}
            </span>
            <h3 class="text-xl sm:text-2xl font-black text-surface-900 leading-snug">
                {{ $message->subject }}
            </h3>
        </div>

        <!-- Message Body -->
        <div class="space-y-2">
            <span class="text-xs font-bold text-surface-400 uppercase tracking-wider block">
                {{ app()->getLocale() === 'ar' ? 'نص الرسالة المكتوبة' : 'Message Body' }}
            </span>
            <div class="p-6 rounded-2xl bg-surface-50 border border-surface-200 text-sm sm:text-base text-surface-800 leading-relaxed whitespace-pre-line font-medium shadow-inner">
                {{ $message->message }}
            </div>
        </div>

        <!-- Quick Response Action Toolbar -->
        <div class="border-t border-surface-100 pt-6">
            <span class="text-xs font-bold text-surface-400 uppercase tracking-wider block mb-4">
                {{ app()->getLocale() === 'ar' ? 'إجراءات الرد والتواصل المباشر مع العميل' : 'Direct Response Channels' }}
            </span>

            <div class="flex flex-wrap items-center gap-3">
                <!-- Reply via Email -->
                <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}&body={{ rawurlencode("السلام عليكم ورحمة الله وبركاته،\nالأستاذ/ة " . $message->name . "،\n\nنشكركم على تواصلكم مع شركة سمارت تك سيستمز (STS) بخصوص: " . $message->subject . ".\n\n") }}" 
                   class="btn-primary text-xs py-3 px-5 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'الرد عبر البريد الإلكتروني' : 'Reply via Email' }}</span>
                </a>

                <!-- Reply via WhatsApp -->
                @if($message->phone)
                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $message->phone);
                        $whatsappMsg = "السلام عليكم ورحمة الله وبركاته، الأستاذ/ة " . $message->name . "، معك فريق شركة STS للأنظمة الذكية والأمنية بخصوص استفساركم الوارد: (" . $message->subject . "). كيف يمكننا خدمتكم؟";
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode($whatsappMsg) }}" target="_blank" rel="noopener" 
                       class="btn-secondary text-xs py-3 px-5 flex items-center gap-2 text-emerald-700 hover:border-emerald-300 hover:bg-emerald-50">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'مراسلة عبر واتساب' : 'Reply via WhatsApp' }}</span>
                    </a>

                    <!-- Direct Call -->
                    <a href="tel:{{ $message->phone }}" class="btn-secondary text-xs py-3 px-5 flex items-center gap-2">
                        <svg class="w-4 h-4 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'اتصال هاتفي مباشر' : 'Direct Call' }}</span>
                    </a>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection
