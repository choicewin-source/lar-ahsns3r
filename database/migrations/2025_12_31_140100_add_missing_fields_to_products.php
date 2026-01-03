<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // إضافة الحقول المفقودة للمنتجات
            if (!Schema::hasColumn('products', 'sub_category')) {
                $table->string('sub_category')->nullable()->after('category');
            }
            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand')->nullable()->after('sub_category');
            }
            if (!Schema::hasColumn('products', 'contact_phone')) {
                $table->string('contact_phone')->nullable()->after('address_details');
            }
            if (!Schema::hasColumn('products', 'image_path')) {
                $table->string('image_path')->nullable()->after('contact_phone');
            }
            if (!Schema::hasColumn('products', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('is_approved')->constrained()->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sub_category', 'brand', 'contact_phone', 'image_path', 'user_id']);
        });
    }
};
