<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // كود العرض (مرجعية) مثل: AS-5092
            $table->string('reference_code')->unique()->nullable()->after('id');
            // حالة الموافقة (مفعلة تلقائياً حالياً حسب طلب شادي، ويمكن تغييرها لاحقاً)
            $table->boolean('is_approved')->default(true)->after('edit_token');
            // رقم التواصل إذا لم يكن موجوداً
            if (!Schema::hasColumn('products', 'contact_phone')) {
                $table->string('contact_phone')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['reference_code', 'is_approved']);
        });
    }
};