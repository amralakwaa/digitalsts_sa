@extends('layouts.admin')

@section('title', __('messages.manage_messages') . ' — STS Executive')
@section('header_title', __('messages.manage_messages'))

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Inquiries -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الرسائل' : 'Total Messages' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit">{{ $stats['total'] }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'كافة الاستفسارات الواردة عبر البوابة' : 'All incoming contact inquiries' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-rose-100 group hover:border-rose-300 transition-all">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs text-rose-800 font-semibold uppercase tracking-wider">
                        {{ app()->getLocale() === 'ar' ? 'رسائل غير مقروءة' : 'Unread Messages' }}
                    </span>
                    @if($stats['unread'] > 0)
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    @endif
                </div>
                <span class="text-3xl font-black text-rose-600 font-outfit">{{ $stats['unread'] }}</span>
                <span class="text-[11px] text-rose-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تتطلب اطلاعاً ومتابعة سريعة' : 'Requires immediate reply' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
        </div>

        <!-- Read / Handled -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'تمت قراءتها' : 'Handled / Read' }}
                </span>
                <span class="text-3xl font-black text-emerald-600 font-outfit">{{ $stats['read'] }}</span>
                <span class="text-[11px] text-emerald-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تمت معالجتها ومراجعتها' : 'Archived & reviewed' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Today's Inquiries -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'وارد اليوم' : 'Received Today' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit">{{ $stats['today'] }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'خلال الـ 24 ساعة الماضية' : 'Past 24 hours' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'صندوق رسائل واستفسارات التواصل' : 'Customer Inquiries Inbox' }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'إدارة رسائل الزوار، استفسارات المشاريع، والدعم الفني المباشر' : 'Review customer feedback, project requests, and support queries' }}
                </span>
            </div>

            <!-- Bulk Actions (shown when rows are selected) -->
            <div id="bulkActionsBar" style="display:none;" class="flex items-center gap-2">
                <button type="button" onclick="submitBulkRead(true)" class="btn-secondary text-xs py-2 px-3 text-emerald-700 hover:border-emerald-300">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'تحديد كمقروء' : 'Mark as Read' }}</span>
                </button>
                <button type="button" onclick="submitBulkDelete()" class="btn-primary text-xs py-2 px-3 bg-rose-600 hover:bg-rose-700 border-rose-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span id="bulkDeleteCountLabel">{{ app()->getLocale() === 'ar' ? 'حذف المحدد' : 'Delete Selected' }}</span>
                </button>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'البحث بالاسم، البريد الإلكتروني، الجوال، أو الموضوع...' : 'Search by name, email, phone, or subject...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Status Filter -->
                <select name="status" class="py-2 px-3 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 focus:outline-none focus:border-brand-500">
                    <option value="all">{{ app()->getLocale() === 'ar' ? 'جميع الرسائل' : 'All Messages' }}</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'غير المقروءة فقط' : 'Unread Only' }}</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'المقروءة فقط' : 'Read Only' }}</option>
                </select>

                <button type="submit" class="btn-secondary text-xs py-2 px-4">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request()->anyFilled(['q', 'status']))
                    <a href="{{ route('admin.messages.index') }}" class="text-xs text-rose-500 hover:underline px-2">
                        {{ app()->getLocale() === 'ar' ? 'إلغاء الفلتر' : 'Reset' }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Messages Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-4 w-10 text-center">
                            <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="rounded border-surface-300 text-brand-600 focus:ring-brand-500 cursor-pointer">
                        </th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'المرسل والاتصال' : 'Sender' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'الموضوع ومحتوى الرسالة' : 'Subject & Content' }}</th>
                        <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'التاريخ' : 'Date' }}</th>
                        <th class="py-3.5 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-brand-50/20 transition-colors {{ !$msg->is_read ? 'bg-brand-50/30 font-semibold' : '' }}">
                            <td class="py-4 px-4 text-center">
                                <input type="checkbox" value="{{ $msg->id }}" class="msg-checkbox rounded border-surface-300 text-brand-600 focus:ring-brand-500 cursor-pointer" onchange="updateBulkUI()">
                            </td>
                            <!-- Sender -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs flex-shrink-0 {{ !$msg->is_read ? 'bg-brand-500 text-white shadow-brand-glow' : 'bg-surface-100 text-surface-600' }}">
                                        {{ mb_substr($msg->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-surface-900 block text-sm">{{ $msg->name }}</span>
                                        <div class="flex flex-wrap items-center gap-2 mt-0.5 text-[11px] text-surface-400 font-normal">
                                            <a href="mailto:{{ $msg->email }}" class="hover:text-brand-600 hover:underline">{{ $msg->email }}</a>
                                            @if($msg->phone)
                                                <span>•</span>
                                                <a href="tel:{{ $msg->phone }}" class="hover:text-surface-700 font-mono" dir="ltr">{{ $msg->phone }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Subject & Excerpt -->
                            <td class="py-4 px-6 max-w-md">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="block font-bold text-surface-900 hover:text-brand-600 transition-colors line-clamp-1">
                                    {{ $msg->subject }}
                                </a>
                                <p class="text-[11px] text-surface-500 font-normal line-clamp-1 mt-0.5">
                                    {{ $msg->message }}
                                </p>
                            </td>

                            <!-- Status Badge with Toggle -->
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.messages.toggleRead', $msg->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cursor-pointer inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold transition-all {{ !$msg->is_read ? 'bg-brand-100 text-brand-700 border border-brand-200 hover:bg-brand-200' : 'bg-surface-100 text-surface-500 border border-surface-200 hover:bg-surface-200' }}" title="{{ app()->getLocale() === 'ar' ? 'انقر للتبديل بين مقروءة وغير مقروءة' : 'Click to toggle read status' }}">
                                        @if(!$msg->is_read)
                                            <span class="w-2 h-2 rounded-full bg-brand-500 animate-ping"></span>
                                            <span>{{ app()->getLocale() === 'ar' ? 'جديدة' : 'New' }}</span>
                                        @else
                                            <span class="w-1.5 h-1.5 rounded-full bg-surface-400"></span>
                                            <span>{{ app()->getLocale() === 'ar' ? 'مقروءة' : 'Read' }}</span>
                                        @endif
                                    </button>
                                </form>
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 text-surface-400 font-medium whitespace-nowrap">
                                <span class="block text-surface-700 font-bold">{{ $msg->created_at->format('Y-m-d') }}</span>
                                <span class="text-[10px] text-surface-400 font-mono block">{{ $msg->created_at->format('H:i') }} ({{ $msg->created_at->diffForHumans() }})</span>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($msg->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" rel="noopener" class="p-1.5 rounded-lg text-emerald-600 hover:bg-emerald-50 transition-colors" title="واتساب">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                                        {{ app()->getLocale() === 'ar' ? 'عرض' : 'View' }}
                                    </a>

                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذه الرسالة؟' : 'Are you sure you want to delete this message?' }}');">
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
                            <td colspan="6" class="text-center py-16 text-surface-400">
                                {{ app()->getLocale() === 'ar' ? 'لا توجد رسائل تواصل واردة حتى الآن.' : 'No customer messages received yet.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
            {{ $messages->links() }}
        </div>
    </div>

</div>

<!-- Hidden Bulk Action Forms -->
<form id="bulkActionForm" method="POST" style="display:none;">
    @csrf
    <div id="bulkIdsContainer"></div>
</form>

<script>
    function toggleSelectAll(master) {
        document.querySelectorAll('.msg-checkbox').forEach(cb => cb.checked = master.checked);
        updateBulkUI();
    }

    function updateBulkUI() {
        const checked = document.querySelectorAll('.msg-checkbox:checked');
        const bar = document.getElementById('bulkActionsBar');
        const countLabel = document.getElementById('bulkDeleteCountLabel');
        const isAr = "{{ app()->getLocale() }}" === 'ar';

        if (checked.length > 0) {
            bar.style.display = 'flex';
            if (countLabel) {
                countLabel.textContent = isAr ? `حذف المحدد (${checked.length})` : `Delete Selected (${checked.length})`;
            }
        } else {
            bar.style.display = 'none';
        }
    }

    function submitBulkDelete() {
        const checked = document.querySelectorAll('.msg-checkbox:checked');
        if (checked.length === 0) return;
        const isAr = "{{ app()->getLocale() }}" === 'ar';
        if (!confirm(isAr ? `هل أنت متأكد من حذف ${checked.length} رسالة محددة؟` : `Are you sure you want to delete ${checked.length} selected messages?`)) {
            return;
        }

        const form = document.getElementById('bulkActionForm');
        form.action = "{{ route('admin.messages.bulkDelete') }}";
        const container = document.getElementById('bulkIdsContainer');
        container.innerHTML = '';
        checked.forEach(cb => {
            container.innerHTML += `<input type="hidden" name="ids[]" value="${cb.value}">`;
        });
        form.submit();
    }

    function submitBulkRead(markAsRead) {
        const checked = document.querySelectorAll('.msg-checkbox:checked');
        if (checked.length === 0) return;

        const form = document.getElementById('bulkActionForm');
        form.action = "{{ route('admin.messages.bulkRead') }}";
        const container = document.getElementById('bulkIdsContainer');
        container.innerHTML = `<input type="hidden" name="mark_as_read" value="${markAsRead ? '1' : '0'}">`;
        checked.forEach(cb => {
            container.innerHTML += `<input type="hidden" name="ids[]" value="${cb.value}">`;
        });
        form.submit();
    }
</script>

@endsection
