<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequestStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'min:8', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:150'],
            'service_id' => ['nullable', 'exists:services,id'],
            'project_type' => ['required', 'string', 'in:commercial,residential,hospitality,industrial,government,other'],
            'location' => ['nullable', 'string', 'max:120'],
            'estimated_budget' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'min:10', 'max:4000'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,zip,jpg,jpeg,png'],
        ];
    }

    public function messages(): array
    {
        $isAr = app()->getLocale() === 'ar';
        return [
            'full_name.required' => $isAr ? 'حقل الاسم الكامل مطلوب.' : 'Full name is required.',
            'email.required' => $isAr ? 'البريد الإلكتروني مطلوب.' : 'Email address is required.',
            'email.email' => $isAr ? 'يرجى إدخال بريد إلكتروني صالح.' : 'Please provide a valid email.',
            'phone.required' => $isAr ? 'رقم الهاتف مطلوب.' : 'Phone number is required.',
            'project_type.required' => $isAr ? 'يرجى اختيار نوع المشروع.' : 'Please select a project type.',
            'message.required' => $isAr ? 'يرجى توضيح تفاصيل ومتطلبات المشروع.' : 'Please describe your project scope.',
            'message.min' => $isAr ? 'تفاصيل المشروع يجب ألا تقل عن 10 أحرف.' : 'Project scope must be at least 10 characters.',
            'attachment.max' => $isAr ? 'حجم الملف يجب ألا يتجاوز 10 ميجابايت.' : 'Attachment size must not exceed 10MB.',
            'attachment.mimes' => $isAr ? 'صيغة الملف غير مدعومة (الملفات المسموحة: PDF, DOC, ZIP, JPG, PNG).' : 'Invalid file format (Allowed: PDF, DOC, ZIP, JPG, PNG).',
        ];
    }
}
