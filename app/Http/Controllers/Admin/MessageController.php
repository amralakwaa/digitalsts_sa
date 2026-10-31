<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('subject', 'like', "%{$q}%")
                    ->orWhere('message', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status') && $request->query('status') !== 'all') {
            if ($request->query('status') === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->query('status') === 'read') {
                $query->where('is_read', true);
            }
        }

        $messages = $query->paginate(15)->withQueryString();

        $stats = [
            'total'  => ContactMessage::count(),
            'unread' => ContactMessage::where('is_read', false)->count(),
            'read'   => ContactMessage::where('is_read', true)->count(),
            'today'  => ContactMessage::whereDate('created_at', today())->count(),
        ];

        return view('admin.messages.index', compact('messages', 'stats'));
    }

    public function show(int $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggleRead(int $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);

        return redirect()->back()->with('success', app()->getLocale() === 'ar'
            ? ($message->is_read ? 'تم تحديد الرسالة كمقروءة.' : 'تم تحديد الرسالة كغير مقروءة.')
            : 'Message status updated.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids) && is_array($ids)) {
            ContactMessage::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', app()->getLocale() === 'ar'
                ? 'تم حذف الرسائل المحددة بنجاح.'
                : 'Selected messages deleted successfully.');
        }

        return redirect()->back()->with('error', app()->getLocale() === 'ar'
            ? 'يرجى تحديد رسالة واحدة على الأقل.'
            : 'Please select at least one message.');
    }

    public function bulkRead(Request $request)
    {
        $ids = $request->input('ids', []);
        $markAs = $request->boolean('mark_as_read', true);

        if (!empty($ids) && is_array($ids)) {
            ContactMessage::whereIn('id', $ids)->update(['is_read' => $markAs]);
            return redirect()->back()->with('success', app()->getLocale() === 'ar'
                ? 'تم تحديث حالة الرسائل المحددة.'
                : 'Selected messages status updated.');
        }

        return redirect()->back()->with('error', app()->getLocale() === 'ar'
            ? 'يرجى تحديد رسالة واحدة على الأقل.'
            : 'Please select at least one message.');
    }

    public function destroy(int $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', app()->getLocale() === 'ar'
            ? 'تم حذف الرسالة بنجاح.'
            : 'Message deleted successfully.');
    }
}
