<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return redirect()->to(route('about') . '#contact', 301);
    }

    public function store(ContactStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', __('messages.contact_success'));

        } catch (\Exception $e) {
            Log::error('Contact message error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', app()->getLocale() === 'ar'
                    ? 'حدث خطأ أثناء إرسال الرسالة، يرجى المحاولة لاحقاً.'
                    : 'An error occurred while sending your message. Please try again later.');
        }
    }
}
