@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إضافة مسؤول جديد' : 'Add New Administrator') . ' — STS Executive')
@section('header_title', app()->getLocale() === 'ar' ? 'إضافة مسؤول جديد' : 'New Administrator')

@section('content')

<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة فريق الإدارة' : 'Back to Administrators List' }}</span>
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="card-light rounded-3xl p-6 sm:p-10 space-y-8 shadow-soft">
        @csrf

        <div class="border-b border-surface-100 pb-4">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'بيانات حساب المسؤول الجديد' : 'New Administrator Account Details' }}
            </h2>
            <p class="text-xs text-surface-400">
                {{ app()->getLocale() === 'ar' ? 'سيتم تشفير كلمة المرور وتفعيل الحساب فوراً وفق معايير الأمان المعتمدة' : 'Passwords are automatically hashed and salted via industry security standards' }}
            </p>
        </div>

        <!-- Role Selection Visual Cards -->
        <div class="space-y-3">
            <label class="block text-xs font-bold text-surface-700 uppercase">
                {{ app()->getLocale() === 'ar' ? 'مستوى الصلاحية الإدارية *' : 'Access Level & Role *' }}
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Full Admin -->
                <label class="relative p-4 rounded-2xl border-2 border-surface-200 hover:border-amber-400 cursor-pointer transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/40 has-[:checked]:shadow-xs group">
                    <input type="radio" name="is_admin" value="1" class="sr-only" {{ old('is_admin', '1') === '1' ? 'checked' : '' }}>
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
                <label class="relative p-4 rounded-2xl border-2 border-surface-200 hover:border-brand-400 cursor-pointer transition-all has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50/40 has-[:checked]:shadow-xs group">
                    <input type="radio" name="is_admin" value="0" class="sr-only" {{ old('is_admin') === '0' ? 'checked' : '' }}>
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
            @error('is_admin')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'الاسم الكامل *' : 'Full Name *' }}
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: م. سلطان الشمري' : 'e.g. Eng. Sultan Al-Shammari' }}"
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
                <input type="email" id="email" name="email" value="{{ old('email') }}" required dir="ltr"
                       placeholder="user@sts.com.sa"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono @error('email') border-rose-500 @enderror">
                @error('email')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="sm:col-span-2">
                <label for="phone" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'رقم الجوال (اختياري)' : 'Phone Number (Optional)' }}
                </label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" dir="ltr"
                       placeholder="+966 5X XXX XXXX"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'كلمة المرور *' : 'Password *' }}
                </label>
                <input type="password" id="password" name="password" required dir="ltr"
                       placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono @error('password') border-rose-500 @enderror">
                <span class="text-[11px] text-surface-400 mt-1 block">
                    {{ app()->getLocale() === 'ar' ? 'الحد الأدنى 8 خانات تتضمن حروفاً وأرقاماً' : 'Minimum 8 characters with numbers & symbols' }}
                </span>
                @error('password')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور *' : 'Confirm Password *' }}
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required dir="ltr"
                       placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
            </div>
        </div>

        <div class="pt-4 border-t border-surface-100 flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="btn-secondary text-xs py-2.5 px-5">
                {{ __('messages.cancel') }}
            </a>
            <button type="submit" class="btn-primary text-xs py-3 px-6 shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'إنشاء حساب المسؤول' : 'Create Administrator' }}</span>
            </button>
        </div>
    </form>
</div>

@endsection
