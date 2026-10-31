<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'full_name',
        'email',
        'phone',
        'company_name',
        'service_id',
        'project_type',
        'location',
        'estimated_budget',
        'message',
        'attachment_path',
        'status',
        'admin_notes',
        'preferred_language',
        'ip_address',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function generateReferenceNumber(): string
    {
        $year = date('Y');
        $random = strtoupper(bin2hex(random_bytes(3))); // 6 hex chars e.g. A1B2C3
        $ref = "STS-{$year}-{$random}";

        while (self::where('reference_number', $ref)->exists()) {
            $random = strtoupper(bin2hex(random_bytes(3)));
            $ref = "STS-{$year}-{$random}";
        }

        return $ref;
    }

    public function getStatusLabelAttribute(): string
    {
        $isAr = app()->getLocale() === 'ar';
        return match ($this->status) {
            'pending' => $isAr ? 'قيد الانتظار' : 'Pending',
            'under_review' => $isAr ? 'قيد المراجعة' : 'Under Review',
            'contacted' => $isAr ? 'تم التواصل' : 'Contacted',
            'completed' => $isAr ? 'مكتمل' : 'Completed',
            'cancelled' => $isAr ? 'ملغي' : 'Cancelled',
            default => $this->status,
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-500/20 text-amber-400 border border-amber-500/30',
            'under_review' => 'bg-sky-500/20 text-sky-400 border border-sky-500/30',
            'contacted' => 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30',
            'completed' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30',
            'cancelled' => 'bg-rose-500/20 text-rose-400 border border-rose-500/30',
            default => 'bg-slate-500/20 text-slate-400 border border-slate-500/30',
        };
    }
}
