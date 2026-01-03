<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // التحقق من وجود جدول ads قبل إنشائه
        if (!Schema::hasTable('ads')) {
            Schema::create('ads', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('text_content')->nullable();
                $table->string('link')->nullable();
                $table->string('image_path')->nullable();
                $table->enum('position', ['top', 'middle', 'bottom'])->default('middle');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // التحقق من وجود جدول comments قبل إنشائه
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->text('content');
                $table->boolean('is_approved')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('ads');
    }
};
