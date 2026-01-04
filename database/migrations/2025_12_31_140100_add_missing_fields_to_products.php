<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // جميع هذه الحقول موجودة بالفعل في create_products_table migration
        // لا نحتاج لإضافتها مرة أخرى
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sub_category', 'brand', 'contact_phone', 'image_path', 'user_id']);
        });
    }
};
