<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // جميع الحقول والفهارس موجودة في create_products_table migration
        // لا نحتاج لإضافة أي شيء هنا
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // لا نحذف الحقول في حالة التراجع لأنها أساسية
            // $table->dropColumn(['reference_code', 'is_approved']);
            
            $table->dropIndex('products_category_sub_index');
            $table->dropIndex(['price']);
        });
    }
};