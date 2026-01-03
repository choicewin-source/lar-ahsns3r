<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // هذه الحقول يجب أن تكون في الهجرة الرئيسية، 
            // ولكن نضيفها هنا للتأكد من التوافق مع النسخ القديمة
            
            if (!Schema::hasColumn('products', 'reference_code')) {
                $table->string('reference_code')->nullable()->after('id');
            }
            
            if (!Schema::hasColumn('products', 'is_approved')) {
                $table->boolean('is_approved')->default(true)->after('edit_token');
            }
            
            // إضافة فهارس لتحسين الأداء
            $table->index(['category', 'sub_category'], 'products_category_sub_index');
            $table->index('price');
        });
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