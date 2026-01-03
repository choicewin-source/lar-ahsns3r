<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // إضافة كود العرض التسلسلي إذا لم يكن موجوداً
            if (!Schema::hasColumn('products', 'reference_code')) {
                $table->string('reference_code')->unique()->after('edit_token');
            }
            
            // إضافة حقل الموافقة إذا لم يكن موجوداً
            if (!Schema::hasColumn('products', 'is_approved')) {
                $table->boolean('is_approved')->default(true)->after('reference_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['reference_code', 'is_approved']);
        });
    }
};
