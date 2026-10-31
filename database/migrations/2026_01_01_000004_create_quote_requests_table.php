<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('project_type')->default('commercial');
            $table->string('location')->nullable();
            $table->string('estimated_budget')->nullable();
            $table->text('message');
            $table->string('attachment_path')->nullable();
            $table->string('status')->default('pending'); // pending, under_review, contacted, completed, cancelled
            $table->text('admin_notes')->nullable();
            $table->string('preferred_language')->default('ar');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
