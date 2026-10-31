<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('category')->default('commercial'); // commercial, residential, hospitality, government, industrial
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
