<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // حذف الجدول القديم إذا كان موجودًا
        Schema::dropIfExists('reports');
        
        // إنشاء الجدول الصحيح
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('product_link')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('reason');
            $table->text('details')->nullable();
            $table->string('reporter_name')->nullable();
            $table->string('reporter_email')->nullable();
            $table->string('reporter_phone')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};