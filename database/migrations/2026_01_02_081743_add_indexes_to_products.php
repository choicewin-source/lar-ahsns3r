<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // إضافة فهارس لتحسين أداء الاستعلامات
            $table->index(['category', 'sub_category', 'is_approved']);
            $table->index(['name', 'is_approved']);
            $table->index(['price', 'created_at']);
            $table->index(['shop_name', 'city']);
            $table->index(['created_at', 'is_approved']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category', 'sub_category', 'is_approved']);
            $table->dropIndex(['name', 'is_approved']);
            $table->dropIndex(['price', 'created_at']);
            $table->dropIndex(['shop_name', 'city']);
            $table->dropIndex(['created_at', 'is_approved']);
        });
    }
};
