@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'فريق الإدارة والمدراء' : 'Administrators & Staff') . ' — STS Executive')
@section('header_title', app()->getLocale() === 'ar' ? 'فريق الإدارة والصلاحيات' : 'Administrators & Access')

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $totalAdmins = \App\Models\User::count();
            $superAdmins = \App\Models\User::where('is_admin', true)->orWhere('role', 'admin')->count();
            $staffCount = $totalAdmins - $superAdmins;
        @endphp

        <!-- Total Accounts -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الحسابات' : 'Total Accounts' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit">{{ $totalAdmins }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'حسابات إدارة المنظومة المعتمدة' : 'Registered platform users' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>

        <!-- Super Admins -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'مدراء النظام الكلي' : 'Super Admins' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit">{{ $superAdmins }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'صلاحيات تنفيذية ومطلقة' : 'Full system privileges' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>

        <!-- Operational Staff -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-sky-100 group hover:border-sky-300 transition-all">
            <div>
                <span class="text-xs text-sky-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'فريق العمل التشغيلي' : 'Operations Staff' }}
                </span>
                <span class="text-3xl font-black text-sky-600 font-outfit">{{ $staffCount }}</span>
                <span class="text-[11px] text-sky-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'إدارة الطلبات والمحتوى' : 'Content & quote handlers' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 border border-sky-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>

        <!-- Current Session Profile -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'حسابك النشط' : 'Current Session' }}
                </span>
                <span class="text-sm font-black text-surface-900 block truncate max-w-[140px]">{{ auth()->user()->name }}</span>
                <span class="text-[11px] text-emerald-600 font-bold block mt-1">
                    ● {{ app()->getLocale() === 'ar' ? 'متصل الآن' : 'Active Online' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center text-sm font-black shadow-xs">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'فريق الإدارة والحسابات المخولة' : 'Authorized Administrators & Staff' }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'إدارة حسابات المسؤولين، الصلاحيات، وبيانات الدخول للوحة التحكم' : 'Manage administrative credentials, security roles, and platform permissions' }}
                </span>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm self-start md:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'إضافة مسؤول جديد' : 'Add Administrator' }}</span>
            </a>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'المسؤول' : 'Administrator' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'الهاتف' : 'Phone' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'نوع الصلاحية' : 'Role & Privileges' }}</th>
                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'ar' ? 'تاريخ الإنشاء' : 'Created Date' }}</th>
                        <th class="py-3.5 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-100">
                    @foreach($users as $u)
                        <tr class="hover:bg-brand-50/20 transition-colors {{ auth()->id() === $u->id ? 'bg-brand-50/15' : '' }}">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-brand-600 to-amber-500 text-white font-black flex items-center justify-center text-sm shadow-xs flex-shrink-0">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-surface-900 block text-sm">{{ $u->name }}</span>
                                            @if(auth()->id() === $u->id)
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-100 text-brand-700 border border-brand-200">
                                                    {{ app()->getLocale() === 'ar' ? 'حسابك الحالي' : 'You' }}
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-[11px] text-surface-400 font-mono block mt-0.5">ID: #{{ $u->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-mono text-surface-700">
                                <a href="mailto:{{ $u->email }}" class="hover:text-brand-600 hover:underline">{{ $u->email }}</a>
                            </td>
                            <td class="py-4 px-6 text-surface-600 font-mono" dir="ltr">
                                {{ $u->phone ?: '—' }}
                            </td>
                            <td class="py-4 px-6">
                                @if($u->isAdmin())
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-xs">
                                        <span>🛡️</span>
                                        <span>{{ app()->getLocale() === 'ar' ? 'مدير نظام كامل' : 'Super Admin' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-medium bg-surface-100 text-surface-600 border border-surface-200">
                                        <span>👤</span>
                                        <span>{{ app()->getLocale() === 'ar' ? 'عضو فريق تشغيلي' : 'Staff Member' }}</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-surface-400 font-medium whitespace-nowrap">
                                <span class="block text-surface-700 font-semibold">{{ $u->created_at ? $u->created_at->format('Y-m-d') : '—' }}</span>
                                <span class="text-[10px] text-surface-400 font-mono block">{{ $u->created_at ? $u->created_at->diffForHumans() : '' }}</span>
                            </td>
                            <td class="py-4 px-6 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-secondary text-xs py-1.5 px-3">
                                        {{ __('messages.edit') }}
                                    </a>
                                    @if(auth()->id() !== $u->id)
                                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المسؤول نهائياً؟' : 'Are you sure you want to delete this administrator account?' }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-surface-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="{{ __('messages.delete') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-surface-100 flex justify-center bg-surface-50/50">
            {{ $users->links() }}
        </div>
    </div>

</div>

@endsection
