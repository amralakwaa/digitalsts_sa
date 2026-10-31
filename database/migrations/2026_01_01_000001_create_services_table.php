<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->json('features_ar')->nullable();
            $table->json('features_en')->nullable();
            $table->json('benefits_ar')->nullable();
            $table->json('benefits_en')->nullable();
            $table->json('sectors_ar')->nullable();
            $table->json('sectors_en')->nullable();
            $table->string('icon')->default('shield-check');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
