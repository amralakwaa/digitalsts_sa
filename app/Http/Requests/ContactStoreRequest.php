<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'min:3', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        $isAr = app()->getLocale() === 'ar';
        return [
            'name.required' => $isAr ? 'حقل الاسم مطلوب.' : 'Name is required.',
            'email.required' => $isAr ? 'البريد الإلكتروني مطلوب.' : 'Email is required.',
            'subject.required' => $isAr ? 'موضوع الرسالة مطلوب.' : 'Subject is required.',
            'message.required' => $isAr ? 'نص الرسالة مطلوب.' : 'Message content is required.',
            'message.min' => $isAr ? 'نص الرسالة يجب ألا يقل عن 10 أحرف.' : 'Message must be at least 10 characters.',
        ];
    }
}
