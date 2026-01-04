<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // reference_code و is_approved موجودان في create_products_table migration
        // لا نحتاج لإضافتهما هنا
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['reference_code', 'is_approved']);
        });
    }
};
