<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->password = Hash::make($validated['password']);
        $user->is_admin = (bool) $validated['is_admin'];
        $user->role = $validated['is_admin'] ? 'admin' : 'staff';
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('admin.users.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم إنشاء المستخدم بنجاح.'
            : 'User created successfully.');
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Prevent admin from removing their own admin status
        if (auth()->id() === $user->id && !$validated['is_admin']) {
            return back()->with('error', app()->getLocale() === 'ar'
                ? 'لا يمكنك إلغاء صلاحية الإدارة عن حسابك الحالي.'
                : 'You cannot remove administrative privileges from your own account.');
        }

        $user->is_admin = (bool) $validated['is_admin'];
        $user->role = $validated['is_admin'] ? 'admin' : 'staff';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم تحديث بيانات المستخدم بنجاح.'
            : 'User updated successfully.');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return back()->with('error', app()->getLocale() === 'ar'
                ? 'لا يمكنك حذف حسابك الإداري الحالي أثناء تسجيل الدخول به.'
                : 'You cannot delete your own active administrator account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف المستخدم بنجاح.'
            : 'User deleted successfully.');
    }
}
