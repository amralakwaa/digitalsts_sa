<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('badge_text_ar')->nullable();
            $table->string('badge_text_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->string('currency', 10)->default('SAR');
            $table->string('billing_period', 50)->default('project'); // project, one_time, monthly, annually
            $table->json('features_ar')->nullable();
            $table->json('features_en')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->date('valid_until')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_offers');
    }
};
