<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*.ar' => ['nullable', 'string'],
            'settings.*.en' => ['nullable', 'string'],
        ]);

        foreach ($validated['settings'] as $key => $values) {
            $setting = SiteSetting::where('key', $key)->first();
            $group = $setting ? $setting->group : 'general';
            SiteSetting::set($key, $values['ar'] ?? null, $values['en'] ?? null, $group);
        }

        Cache::flush();

        return redirect()->route('admin.settings.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حفظ وتحديث إعدادات الموقع بنجاح.'
            : 'Site settings updated successfully.');
    }
}
