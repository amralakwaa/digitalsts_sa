@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل بيانات المسؤول: ' : 'Edit Admin: ') . $user->name . ' — STS Executive')
@section('header_title', (app()->getLocale() === 'ar' ? 'تعديل بيانات المسؤول' : 'Edit Administrator'))

@section('content')

<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة فريق الإدارة' : 'Back to Administrators List' }}</span>
        </a>

        @if(auth()->id() !== $user->id)
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا الحساب نهائياً؟' : 'Are you sure you want to permanently delete this user?' }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 text-xs font-bold transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>{{ __('messages.delete') }}</span>
                </button>
            </form>
        @else
            <span class="text-xs font-bold text-brand-600 bg-brand-50 border border-brand-200 px-3 py-1.5 rounded-xl">
                🛡️ {{ app()->getLocale() === 'ar' ? 'أنت تقوم بتعديل حسابك النشط' : 'Editing Your Own Account' }}
            </span>
        @endif
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="card-light rounded-3xl p-6 sm:p-10 space-y-8 shadow-soft">
        @csrf
        @method('PUT')

        <div class="border-b border-surface-100 pb-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-surface-900">
                    {{ app()->getLocale() === 'ar' ? 'تعديل بيانات المسؤول' : 'Update Administrator Details' }}
                </h2>
                <p class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'اترك حقول كلمة المرور فارغة إذا لم تكن ترغب في تغييرها' : 'Leave password fields blank to retain the current password' }}
                </p>
            </div>
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-brand-600 to-amber-500 text-white font-black flex items-center justify-center text-sm shadow-xs flex-shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        </div>

        <!-- Role Selection Visual Cards -->
        <div class="space-y-3">
            <label class="block text-xs font-bold text-surface-700 uppercase">
                {{ app()->getLocale() === 'ar' ? 'مستوى الصلاحية الإدارية *' : 'Access Level & Role *' }}
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Full Admin -->
                <label class="relative p-4 rounded-2xl border-2 border-surface-200 hover:border-amber-400 cursor-pointer transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/40 has-[:checked]:shadow-xs group">
                    <input type="radio" name="is_admin" value="1" class="sr-only" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg flex-shrink-0 group-hover:scale-105 transition-transform">
                            🛡️
                        </div>
                        <div>
                            <span class="block text-sm font-black text-surface-900">{{ app()->getLocale() === 'ar' ? 'مدير نظام كامل' : 'Super Admin' }}</span>
                            <span class="text-[11px] text-surface-400 block mt-0.5 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'صلاحيات كاملة تشمل إدارة المستخدمين، الإعدادات، والتحكم الشامل.' : 'Full access to users, system settings, and all modules.' }}
                            </span>
                        </div>
                    </div>
                </label>

                <!-- Staff Member -->
                <label class="relative p-4 rounded-2xl border-2 border-surface-200 hover:border-brand-400 cursor-pointer transition-all has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50/40 has-[:checked]:shadow-xs group {{ auth()->id() === $user->id ? 'opacity-50 cursor-not-allowed' : '' }}">
                    <input type="radio" name="is_admin" value="0" class="sr-only" {{ !old('is_admin', $user->is_admin) ? 'checked' : '' }} {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-lg flex-shrink-0 group-hover:scale-105 transition-transform">
                            👤
                        </div>
                        <div>
                            <span class="block text-sm font-black text-surface-900">{{ app()->getLocale() === 'ar' ? 'عضو فريق تشغيلي' : 'Staff Member' }}</span>
                            <span class="text-[11px] text-surface-400 block mt-0.5 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'إدارة الطلبات، الخدمات، والمحتوى بدون المساس بالإعدادات الحساسة.' : 'Operations access to quotes, content, and inquiries.' }}
                            </span>
                        </div>
                    </div>
                </label>
            </div>
            @if(auth()->id() === $user->id)
                <input type="hidden" name="is_admin" value="1">
                <span class="text-[11px] text-amber-600 font-semibold block mt-1">
                    ℹ️ {{ app()->getLocale() === 'ar' ? 'لا يمكن تقليص صلاحيات حسابك الحالي لأسباب أمنية.' : 'You cannot downgrade your own active admin account.' }}
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'الاسم الكامل *' : 'Full Name *' }}
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all @error('name') border-rose-500 @enderror">
                @error('name')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني المعتمد *' : 'Official Email *' }}
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required dir="ltr"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono @error('email') border-rose-500 @enderror">
                @error('email')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="sm:col-span-2">
                <label for="phone" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'رقم الجوال' : 'Phone Number' }}
                </label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" dir="ltr"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'كلمة المرور الجديدة (اختياري)' : 'New Password (Optional)' }}
                </label>
                <input type="password" id="password" name="password" dir="ltr"
                       placeholder="{{ app()->getLocale() === 'ar' ? 'اتركه فارغاً للإبقاء على الحالية' : 'Leave empty to keep current' }}"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono @error('password') border-rose-500 @enderror">
                <span class="text-[11px] text-surface-400 mt-1 block">
                    {{ app()->getLocale() === 'ar' ? 'الحد الأدنى 8 خانات (في حال التغيير)' : 'Minimum 8 characters if changing' }}
                </span>
                @error('password')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور الجديدة' : 'Confirm New Password' }}
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" dir="ltr"
                       placeholder="{{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور الجديدة' : 'Confirm new password' }}"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
            </div>
        </div>

        <div class="pt-4 border-t border-surface-100 flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="btn-secondary text-xs py-2.5 px-5">
                {{ __('messages.cancel') }}
            </a>
            <button type="submit" class="btn-primary text-xs py-3 px-6 shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ __('messages.save_changes') }}</span>
            </button>
        </div>
    </form>
</div>

@endsection
